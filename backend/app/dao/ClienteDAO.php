<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class ClienteDAO extends DAOAbstract implements DAOInterface {

    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
        parent::__construct();
    }

    public function create($item) {
        //NOP
    }

    public function delete($id) {
        //NOP
    }

    public function read() {
        $stmt = $this->getPdo()->prepare("SELECT * FROM anagrafica_cliente order by rag_sociale");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function readCluster($cf){
        $stmt = $this->getPdo()->prepare("SELECT cluster FROM anagrafica_cliente_cluster where cod_cf= :cf LIMIT 1");
        $stmt->bindValue('cf', $cf);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function readParametriControllo($ct, $year, $month, $id_livello, $desc_livello) {
        $livello = '';
        $livelloDesc = '';
        switch ($id_livello) {
            case "5":
                $livello = "COD_ARTICOLO";
                $livelloAnagrafica = "CODICE_ARTICOLO";
                $livelloDesc = 'DESCRIZIONE';
                break;
            case "4":
                $livello = "COD_TIPO";
                $livelloAnagrafica = "COD_TIPO";
                $livelloDesc = 'TIPO';
                break;
            case "3":
                $livello = "COD_LINEA";
                $livelloAnagrafica = "COD_LINEA";
                $livelloDesc = 'LINEA';
                break;
            case "2":
                $livello = "COD_FAMIGLIA";
                $livelloAnagrafica = "COD_FAMIGLIA";
                $livelloDesc = 'FAMIGLIA';
                break;
            case "1":
                $livello = "COD_DIVISIONE";
                $livelloAnagrafica = "COD_DIVISIONE";
                $livelloDesc = 'DIVISIONE';
                break;
            default:
                break;
        }

        $sql = "SELECT 
                    CT,
                    CF,
                    " . $livello . " as ID_LIVELLO,
                    " . $livelloDesc . " as DESCRIZIONE_LIVELLO,
                    SUM(fatturatonetto) AS TOTFATTNETTO,
                    SUM(fatturatolordo) AS TOTFATTLORDO,
                    COALESCE(100*(1-SUM(fatturatonetto)/SUM(fatturatolordo)),0) AS SCONTO,
                    COALESCE(SUM(KGFATTURATI),1) as KGFATTURATI,
                    COALESCE(SUM(fatturatolordo)/SUM(KGFATTURATI),0) AS PREZZOKG
                FROM
                    V_ORDINI
                WHERE 
                    CT = :ct AND " . $livello . " = :desc_livello and DT_FATTURA < :topdate and  DT_FATTURA>=:bottomdate  
                GROUP BY CT, CF, " . $livello . ", ".$livelloDesc."
                UNION
                SELECT
                    CT,
                    CT AS CF,
                    " . $livello . " as ID_LIVELLO,
                    " . $livelloDesc . " as DESCRIZIONE_LIVELLO,
                    SUM(fatturatonetto) AS TOTFATTNETTO,
                    SUM(fatturatolordo) AS TOTFATTLORDO,
                    COALESCE(100*(1-SUM(fatturatonetto)/SUM(fatturatolordo)),0) AS SCONTO,
                    COALESCE(SUM(KGFATTURATI),0) as KGFATTURATI,
                    COALESCE(SUM(fatturatolordo)/SUM(KGFATTURATI),0) AS PREZZOKG
                FROM
                    V_ORDINI 
                WHERE 
                    CT = :ct AND " . $livello . " = :desc_livello and DT_FATTURA < :topdate and  DT_FATTURA>=:bottomdate  
                GROUP BY CT, CF, " . $livello . ", ".$livelloDesc;
        $stmt = $this->getPdo()->prepare($sql);
        $topdate = $year . '-' . $month . '-01';
        $bottomdate = (((int) $year - 1)) . '-' . $month . '-01';
        $stmt->bindValue('desc_livello', $desc_livello);
        $stmt->bindValue('bottomdate', $bottomdate);
        $stmt->bindValue('topdate', $topdate);
        $stmt->bindValue('ct', $ct);

        $stmt->execute();
        $res = $stmt->fetchAll();
        if ($res==null||count($res)==0){
            //Nel caso in cui non ci siano dati, restituiamo comunque almeno il descrittivo del prodotto
            $sql = "
                SELECT
                    " . $livelloAnagrafica . " as ID_LIVELLO,
                    " . $livelloDesc . " as DESCRIZIONE_LIVELLO
                FROM
                    anagrafica_prodotti_rovagnati 
                WHERE 
                    ".$livelloAnagrafica." = :desc_livello
                GROUP BY " . $livelloAnagrafica . ", ".$livelloDesc;
            $stmt = $this->getPdo()->prepare($sql);
            $stmt->bindValue('desc_livello', $desc_livello);
            $stmt->execute();
            $res = $stmt->fetchAll();
            return $res;
                    
        }
        return $res;
    }

    public function readDatiFatturazione($ct, $anno,  $datainizio, $datafine, $area) {
        $sql = "
                SELECT 
                    CF,
                    DIVISIONE,
                    SUM(fatturatonetto) AS TOTFATT
                FROM
                    V_ORDINI o left join anagrafica_prodotti_zonepromo p on (p.id_linea=o.cod_linea)
                WHERE  CT = :ct and p.id_zona = :id_zona";
        if ($anno!=null){
            $sql .= " AND YEAR(dt_fattura) = :anno ";
        } else {
            $sql .= " AND dt_fattura >= :datainizio AND dt_fattura <= :datafine ";
        }        
                    
        $sql .= "GROUP BY CT, CF, DIVISIONE
                HAVING TOTFATT >0.0;";
   
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindValue('ct', $ct);
        $stmt->bindValue('id_zona', $area);
        if ($anno!=null){
            $stmt->bindValue('anno', $anno);
        } else {
            $stmt->bindValue('datafine', $datafine);
            $stmt->bindValue('datainizio', $datainizio);
        }   
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function elencoCodiciCF($ct) {
        $stmt = $this->getPdo()->prepare("
                SELECT 
                        CT,COD_CF, RAG_SOCIALE
                FROM
                    anagrafica_cliente c
                WHERE
                    ct = :ct and tipo = 'CF'
                GROUP BY CT,COD_CF, RAG_SOCIALE
                ORDER BY CT,COD_CF;");
        $stmt->bindValue('ct', $ct);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update($item) {
        //NOP
    }

    public function readByID($id) {
        $stmt = $this->getPdo()->prepare(""
                . "SELECT c.*, ag.id as id_agente, COALESCE(p.id, 0) as ID_PROFILO, COALESCE(p.desc_profilo,'') as PROFILO "
                . "FROM anagrafica_cliente c  join anagrafica_utente ag on (ag.cod_dipendente = c.agente) "
                . " left join survey_cliente_profilo cp on (c.id=cp.id_cliente) "
                . " left join survey_profilo p on (p.id=cp.ID_PROFILO) "
                . "WHERE c.id= :id;");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function elencoClienti($id, $application, $itemsPerPage, $currentPage, $localita, $provincia) {
        $user = $this->userDAO->readByID($id);
        $ruolo = $user['ruolo'];
        $sql = '';
        if ($application == 'CONTRATTINI') {
            $sql = "SELECT c.ID AS ID,
                        c.COD_CLI AS COD_CLIENTE,
                        c.RAG_SOCIALE AS NOME,
                        c.INDIRIZZO AS VIA,
                        c.CAP AS CAP,
                        c.LOCALITA AS CITTA,
                        c.PROVINCIA_NAZIONE AS PROVINCIA,
                        c.NAZIONE as NAZIONE,
                        c.COD_CF AS COD_CF,
                        c.CT as CT,
                        c.AGENTE AS COD_AGENTE,
                        c.COD_ISPETTORE AS COD_ISPETTORE,
                        c.COD_CAPO_AREA AS COD_CAPOAREA,
                        c.LATITUDINE, c.LONGITUDINE,
                        c.tipo,
                        p.id_zona,
                        (SELECT 
                            COUNT(DISTINCT (cod_cf)) AS totCF
                        FROM
                            anagrafica_cliente c2
                        WHERE
                            c2.CT = c.CT AND c2.cod_cf != c2.ct) AS TOTCF
                        FROM
                    anagrafica_cliente c left join anagrafica_province_zonepromo p on (p.id_provincia = c.provincia_nazione)
                WHERE
                    c.nazione = 'IT' AND tipo !='DM' AND c.cod_cli = c.ct AND c.DESC_CAT_MERCEOLOGICA != 'Z - NON USARE'";
        } else if ($application == 'RILEVAZIONI') {
            $sql = "SELECT c.ID AS ID,
                        c.COD_CLI AS COD_CLIENTE,
                        c.RAG_SOCIALE AS NOME,
                        c.INDIRIZZO AS VIA,
                        c.CAP AS CAP,
                        c.LOCALITA AS CITTA,
                        c.PROVINCIA_NAZIONE AS PROVINCIA,
                        c.NAZIONE as NAZIONE,
                        c.COD_CF AS COD_CF,
                        c.CT as CT,
                        c.AGENTE AS COD_AGENTE,
                        c.COD_ISPETTORE AS COD_ISPETTORE,
                        c.COD_CAPO_AREA AS COD_CAPOAREA,
                        c.LATITUDINE, c.LONGITUDINE,
                        '0' as TOTCF,
                        c.tipo"
                    . " FROM anagrafica_cliente c "
                    . " WHERE tipo IN ('DM', 'CF') and nazione='IT' and DESC_CAT_MERCEOLOGICA !='Z - NON USARE' ";
        }
        switch ($ruolo) {
            case 'AGENTE':
                $sql .= " AND c.agente = :cod_dipendente";
                break;
            case 'ISPETTORE':
                $sql .= " AND c.cod_ispettore = :cod_dipendente";
                break;
            case 'CAPOAREA':
                $sql .= " AND c.cod_capo_area = :cod_dipendente";
                break;
        }
        if ($localita != '' && $provincia!='') {
            $sql .= ' AND c.LOCALITA = :localita AND c.PROVINCIA_NAZIONE = :provincia ';
        }
        $countSql = "SELECT count(*) as numrecords FROM (" . $sql . ") t";
        $stmt = $this->getPdo()->prepare($countSql);
        $stmt->bindValue('cod_dipendente', $user['cod_dipendente']);
        if ($localita != '' && $provincia!='') {
            $stmt->bindValue('localita', $localita);
            $stmt->bindValue('provincia', $provincia);
        }
        $stmt->execute();
        $count = $stmt->fetchAll();
        $numRecords = $count[0]['numrecords'];
        $offset = ($currentPage - 1) * $itemsPerPage;
        $sql .= ' ORDER BY c.RAG_SOCIALE';
        if ($currentPage != -1) {
            $sql .= ' LIMIT ' . $itemsPerPage . ' OFFSET ' . $offset;
        }
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindValue('cod_dipendente', $user['cod_dipendente']);
        if ($localita != '' && $provincia!='') {
            $stmt->bindValue('localita', $localita);
            $stmt->bindValue('provincia', $provincia);
        }
        $stmt->execute();
        $clienti = $count = $stmt->fetchAll();
        return array(
            'clienti' => $clienti,
            'count' => $numRecords
        );
    }
    
    public function readCoordinateRilevate($id_cliente) {
         $sql = "SELECT latitudine_rilevata, longitudine_rilevata FROM anagrafica_cliente where id = :id_cliente";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function updateCoordinateRilevate($id_cliente, $coordinate) {
        $sql = "UPDATE anagrafica_cliente SET latitudine_rilevata = :lat, longitudine_rilevata = :long where id = :id_cliente";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('lat', $coordinate['latitudine']);
        $stmt->bindParam('long', $coordinate['longitudine']);
        $stmt->bindParam('id_cliente', $id_cliente);
        

        $stmt->execute();
        return $id_cliente;
    }

}
