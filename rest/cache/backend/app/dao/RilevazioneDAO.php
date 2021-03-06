<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class RilevazioneDAO__AopProxied extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    }

    public function create($schedaRilevazione) {
        $datiRilevazione = $schedaRilevazione['rilevazione'][0];
        $id_rilevazione = $datiRilevazione['id_rilevazione'];
        $id_utente = $datiRilevazione['id_utente'];
        $id_cliente = $datiRilevazione['id_cliente'];
        $id_scheda_rilevazione = $this->createSchedaRilevazione($id_cliente, $id_rilevazione, $id_utente);
        $this->insertDatiProdotto($id_scheda_rilevazione, $schedaRilevazione);

    }
    
    public function createSchedaRilevazione($id_cliente,$id_rilevazione,$id_utente) {
        //Crea record principale sulla tabella "survey_scheda_rilevazione"
        $sql = "INSERT INTO survey_scheda_rilevazione(DATA_CREAZIONE,DATA_AGGIORNAMENTO,ID_RILEVAZIONE,ID_UTENTE_CREA,ID_CLIENTE) "
                . " VALUES (now(), now(),:id_rilevazione,:id_utente,:id_cliente ) ";
        $stmt = $this->getPdo()->prepare($sql);
        
        $stmt->bindParam('id_rilevazione', $id_rilevazione);
        $stmt->bindParam('id_utente', $id_utente);
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->execute();
        return $this->getPdo()->lastInsertId();
    }

    public function createProdotto($datiProdotto,$id_cliente,$id_rilevazione) {
        $scheda_rilevazione = $this->readSchedaRilevazione($id_cliente, $id_rilevazione);
        $id_scheda_rilevazione = '';
        if ($scheda_rilevazione==null){
            $id_utente = $datiProdotto['id_utente'];
            $id_scheda_rilevazione = $this->createSchedaRilevazione($id_cliente, $id_rilevazione, $id_utente);
        } else {
            $id_scheda_rilevazione = $scheda_rilevazione[0]['id'];
        }
        $sql = "INSERT INTO survey_informazioni_prodotto(PREZZO,ORDINE,PROMOZIONE,TOPSELL,ID_SCHEDA_RILEVAZIONE, ID_TIPO_PRODOTTO, ID_TIPO_ROVAGNATI, ID_CONCORRENTE, NOME_FORNITORE) "
                . " VALUES (:prezzo, :ordine, :promozione, :topsell, :id_scheda_rilevazione, :id_tipo_prodotto, :id_tipo_rovagnati, :id_concorrente, :nome_fornitore) ";
        $stmt = $this->getPdo()->prepare($sql);
        $prezzo = $datiProdotto['prezzo_prodotto'];
        $ordine = $datiProdotto['ordine_prodotto'];
        $promozione = $datiProdotto['prodotto_in_promozione'];
        $topsell = $datiProdotto['prodotto_top_seller'];
        $nome_fornitore  = $datiProdotto['nome_fornitore'];

        $id_tipo_prodotto = null;
        if (isset($datiProdotto['id_tipo_prodotto'])) {
            $id_tipo_prodotto = $datiProdotto['id_tipo_prodotto'];
        }
        $id_tipo_rovagnati = null;
        if (isset($datiProdotto['id_tipo_prodotto_rovagnati'])) {
            $id_tipo_rovagnati = $datiProdotto['id_tipo_prodotto_rovagnati'];
        }
        $id_concorrente = null;
        if (isset($datiProdotto['id_concorrente'])) {
            $id_concorrente = $datiProdotto['id_concorrente'];
        }
        $stmt->bindParam('prezzo', $prezzo);
        $stmt->bindParam('ordine', $ordine);
        $stmt->bindParam('promozione', $promozione);
        $stmt->bindParam('topsell', $topsell);
        $stmt->bindParam('id_scheda_rilevazione', $id_scheda_rilevazione);
        $stmt->bindParam('id_tipo_prodotto', $id_tipo_prodotto);
        $stmt->bindParam('id_tipo_rovagnati', $id_tipo_rovagnati);
        $stmt->bindParam('id_concorrente', $id_concorrente);
        $stmt->bindParam('nome_fornitore', $nome_fornitore);
        $stmt->execute();
        return $this->readProdotto($this->getPdo()->lastInsertId());
    }

    public function deleteProdotto($id_informazioni_prodotto) {
        $sql = "DELETE FROM  "
                . "survey_informazioni_prodotto "
                . " WHERE id=:id";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id', $id_informazioni_prodotto);
        $stmt->execute();
        return 'ok';
    }

    
    public function updateProdotto($datiProdotto,$id_informazioni_prodotto) {

        //Aggiorna record principale sulla tabella "survey_scheda_rilevazione"
        $id_utente = $datiProdotto['id_utente'];
        $sql = "UPDATE survey_scheda_rilevazione SET DATA_AGGIORNAMENTO = now(), ID_UTENTE_MOD = :id_utente "
                . "WHERE id = (select id_scheda_rilevazione from survey_informazioni_prodotto where id=:id)";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id', $id_informazioni_prodotto);
        $stmt->bindParam('id_utente', $id_utente);
        $stmt->execute();
        
        $sql = "UPDATE "
                . "survey_informazioni_prodotto "
                . "SET PREZZO = if (:prezzo  IS NULL,PREZZO, :prezzo),"
                . "ORDINE = if (:ordine  IS NULL,ORDINE, :ordine),"
                . "PROMOZIONE = if (:promozione  IS NULL, PROMOZIONE, :promozione),"
                . "TOPSELL = if (:topsell  IS NULL, TOPSELL, :topsell),"
                . "ID_TIPO_PRODOTTO = if (:id_tipo_prodotto  IS NULL,ID_TIPO_PRODOTTO, :id_tipo_prodotto),"
                . "ID_TIPO_ROVAGNATI = if (:id_tipo_rovagnati  IS NULL,ID_TIPO_ROVAGNATI, :id_tipo_rovagnati),"
                . "ID_CONCORRENTE = if (:id_concorrente  IS NULL,ID_CONCORRENTE, :id_concorrente), "
                . "NOME_FORNITORE = if (:nome_fornitore  IS NULL,NOME_FORNITORE, :nome_fornitore) "
                . " WHERE id = :id ";
        $stmt = $this->getPdo()->prepare($sql);
        $prezzo = $datiProdotto['prezzo_prodotto'];
        $ordine = $datiProdotto['ordine_prodotto'];
        $promozione = $datiProdotto['prodotto_in_promozione'];
        $topsell = $datiProdotto['prodotto_top_seller'];
        
        if ($topsell=='1'){
            $prodotto = $this->readProdottoFull($id_informazioni_prodotto);
            $id_scheda_rilevazione = $prodotto[0]['id_scheda_rilevazione'];
            $id_aggregante = $prodotto[0]['id_aggregante_tipo_prodotto'];
            $sqlReset =  "UPDATE "
                . "survey_informazioni_prodotto p "
                    . "join anagrafica_tipo_prodotto tp on (tp.id = p.id_tipo_prodotto) "
                    . "SET TOPSELL='0' "
                    . "WHERE id_scheda_rilevazione = :id_scheda_rilevazione and tp.id_aggregante = :id_aggregante";
            $stmtReset = $this->getPdo()->prepare($sqlReset);
            $stmtReset->bindParam('id_aggregante', $id_aggregante);
            $stmtReset->bindParam('id_scheda_rilevazione', $id_scheda_rilevazione);
            $stmtReset->execute();
            
        }
        $nome_fornitore  = $datiProdotto['nome_fornitore'];

        $id_tipo_prodotto = null;
        if (isset($datiProdotto['id_tipo_prodotto'])) {
            $id_tipo_prodotto = $datiProdotto['id_tipo_prodotto'];
        }
        $id_tipo_rovagnati = null;
        if (isset($datiProdotto['id_tipo_prodotto_rovagnati'])) {
            $id_tipo_rovagnati = $datiProdotto['id_tipo_prodotto_rovagnati'];
        }
        $id_concorrente = null;
        if (isset($datiProdotto['id_concorrente'])) {
            $id_concorrente = $datiProdotto['id_concorrente'];
        }
        $stmt->bindParam('prezzo', $prezzo);
        $stmt->bindParam('ordine', $ordine);
        $stmt->bindParam('promozione', $promozione);
        $stmt->bindParam('topsell', $topsell);
        $stmt->bindParam('id_tipo_prodotto', $id_tipo_prodotto);
        $stmt->bindParam('id_tipo_rovagnati', $id_tipo_rovagnati);
        $stmt->bindParam('id_concorrente', $id_concorrente);
        $stmt->bindParam('nome_fornitore', $nome_fornitore);
        $stmt->bindParam('id', $id_informazioni_prodotto);
        $stmt->execute();
        return $this->readProdotto($id_informazioni_prodotto);

    }


    
    public function update($schedaRilevazione){ 
        //Aggiorna record principale sulla tabella "survey_scheda_rilevazione"
        $id_scheda_rilevazione = $schedaRilevazione['rilevazione'][0]['id_scheda_rilevazione'];
        $sql = "UPDATE survey_scheda_rilevazione SET DATA_AGGIORNAMENTO = now() WHERE id = :id_scheda_rilevazione";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_scheda_rilevazione',$id_scheda_rilevazione);
        $stmt->execute();
        $this->insertDatiProdotto($id_scheda_rilevazione, $schedaRilevazione);
        
    }
    
    private function insertDatiProdotto($id_scheda_rilevazione,$schedaRilevazione){
        
        $sql = "DELETE FROM survey_informazioni_prodotto WHERE ID_SCHEDA_RILEVAZIONE =  :id_scheda_rilevazione";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_scheda_rilevazione', $id_scheda_rilevazione);
        $stmt->execute();

        //TODO AGGIUNGERE CONCORRENTE
        $sql = "INSERT INTO survey_informazioni_prodotto(PREZZO,ORDINE,PROMOZIONE,TOPSELL,ID_SCHEDA_RILEVAZIONE, ID_TIPO_PRODOTTO, ID_TIPO_ROVAGNATI, ID_CONCORRENTE, NOME_FORNITORE) "
                . " VALUES (:prezzo, :ordine, :promozione, :topsell, :id_scheda_rilevazione, :id_tipo_prodotto, :id_tipo_rovagnati, :id_concorrente, :nome_fornitore) ";
        $stmt = $this->getPdo()->prepare($sql);
        foreach ($schedaRilevazione['rilevazione'] as $datiProdotto) {
            $prezzo = $datiProdotto['prezzo_prodotto'];
            $ordine = $datiProdotto['ordine_prodotto'];
            $promozione = $datiProdotto['prodotto_in_promozione'];
            $topsell = $datiProdotto['prodotto_top_seller'];
            $nome_fornitore  = $datiProdotto['nome_fornitore'];
            $id_tipo_prodotto = null;
            if (isset($datiProdotto['id_tipo_prodotto'])) {
                $id_tipo_prodotto = $datiProdotto['id_tipo_prodotto'];
            }
            $id_tipo_rovagnati = null;
            if (isset($datiProdotto['id_tipo_prodotto_rovagnati'])) {
                $id_tipo_rovagnati = $datiProdotto['id_tipo_prodotto_rovagnati'];
            }
            $id_concorrente = null;
            if (isset($datiProdotto['id_concorrente'])) {
                $id_concorrente = $datiProdotto['id_concorrente'];
            }
            $stmt->bindParam('prezzo', $prezzo);
            $stmt->bindParam('ordine', $ordine);
            $stmt->bindParam('promozione', $promozione);
            $stmt->bindParam('topsell', $topsell);
            $stmt->bindParam('id_scheda_rilevazione', $id_scheda_rilevazione);
            $stmt->bindParam('id_tipo_prodotto', $id_tipo_prodotto);
            $stmt->bindParam('id_tipo_rovagnati', $id_tipo_rovagnati);
            $stmt->bindParam('id_concorrente', $id_concorrente);
            $stmt->bindParam('nome_fornitore', $nome_fornitore);
            $stmt->execute();
        }
    }
    
    
    
    public function delete($id) {
        //NOP
    }

    public function readByID($id) {
        //NOP
    }


    public function readProdotto($id) {
        $stmt = $this->getPdo()->prepare("
            SELECT ID,
                PREZZO,
                ORDINE,
                PROMOZIONE,
                TOPSELL,
                ID_SCHEDA_RILEVAZIONE,
                ID_CONCORRENTE,
                ID_TIPO_PRODOTTO,
                ID_TIPO_ROVAGNATI,
                NOME_FORNITORE
            FROM survey_informazioni_prodotto
            WHERE ID = :id    ");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readProdottoFull($id) {
        $stmt = $this->getPdo()->prepare("
            SELECT *
            FROM v_survey_scheda_rilevazione
            WHERE id_dati_prodotto = :id    ");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    

    public function readSchedaRilevazione($id_cliente,$id_rilevazione) {
        $stmt = $this->getPdo()->prepare("
            SELECT ID,
                DATA_CREAZIONE,
                DATA_AGGIORNAMENTO,
                ID_RILEVAZIONE,
                ID_UTENTE_CREA,
                ID_UTENTE_MOD,
                ID_CLIENTE
            FROM survey_scheda_rilevazione 
            WHERE ID_CLIENTE = :id_cliente and ID_RILEVAZIONE = :id_rilevazione
        ");
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->bindParam('id_rilevazione', $id_rilevazione);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readRilevazioneInCorso() {
        $stmt = $this->getPdo()->prepare("
            SELECT 
                s.id,s.data_inizio, s.data_fine, f.id as id_famiglia, f.desc_famiglia as descrizione_famiglia
            FROM
                survey_rilevazione s
                    JOIN
                anagrafica_famiglia_prodotto f ON (f.ID = ID_FAMIGLIA)
            WHERE
                s.data_inizio <= SYSDATE()
                    AND s.data_fine >= SYSDATE();");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readRilevazione($id_rilevazione, $id_punto_vendita) {
        $stmt = $this->getPdo()->prepare(""
                . "SELECT * FROM v_survey_scheda_rilevazione s "
                . "WHERE s.id_rilevazione = :id_rilevazione "
                . " and s.id_cliente= :id_punto_vendita"
                . " order by ORDINE_PRODOTTO");

        $stmt->bindParam('id_rilevazione', $id_rilevazione);
        $stmt->bindParam('id_punto_vendita', $id_punto_vendita);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function read() {
        
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\RilevazioneDAO.php';

