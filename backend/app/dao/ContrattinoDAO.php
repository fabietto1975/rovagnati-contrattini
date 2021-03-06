<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class ContrattinoDAO extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    }

    public function create($contrattino) {

        $stmt = $this->getPdo()->prepare("INSERT INTO CONTRATTO_BASICDATA("
                . "ID_CLIENTE, "
                . "DATA_CREAZIONE, "
                . "DESCRIZIONE, "
                . "ID_UTENTE_CREA, "
                . "STATO, "
                . "CODICE_FATTURAZIONE_TOTALE, "
                . "CODICI_FATTURAZIONE, "
                . "LIQUIDAZIONE, "
                . "DATA_INSERIMENTO, "
                . "NOTEAGENTE, "
                . "NOTEISPETTORE,"
                . "NOTECAPOAREA,"
                . "MODALITALIQUIDAZIONE,
                   TEMPISTICADILIQUIDAZIONE,
                   MESEANNOINIZIO,
                   MESEANNOFINE,
                   MODALITADEFINIZIONEOBBIETTIVO,
                   MODALITADEFINIZIONEPREMIO,
                   OBBIETTIVO_VALORE_1,
                   OBBIETTIVO_PREMIO_1,
                   OBBIETTIVO_VALORE_2,
                   OBBIETTIVO_PREMIO_2,
                   OBBIETTIVO_VALORE_3,
                   OBBIETTIVO_PREMIO_3,
                   OBBIETTIVO_VALORE_4,
                   OBBIETTIVO_PREMIO_4,
                   OBBIETTIVO_VALORE_5,
                   OBBIETTIVO_PREMIO_5) "
                . "VALUES ("
                . ":id_cliente, "
                . "now(), "
                . ":descrizione, "
                . ":id_utente_crea, "
                . ":stato, "
                . ":codice_fatturazione_totale, "
                . ":codici_fatturazione, "
                . ":liquidazione,"
                . ":data_inserimento,"
                . ":note_agente, "
                . ":note_ispettore, "
                . ":note_capoarea,"
                . " :modalitaliquidazione,
                    :tempisticadiliquidazione, 
                    :meseannoinizio,
                    :meseannofine,
                    :modalitadefinizioneobbiettivo,
                    :modalitadefinizionepremio,
                    :obbiettivo_valore_1,
                    :obbiettivo_premio_1,
                    :obbiettivo_valore_2,
                    :obbiettivo_premio_2,
                    :obbiettivo_valore_3,
                    :obbiettivo_premio_3,
                    :obbiettivo_valore_4,
                    :obbiettivo_premio_4,
                    :obbiettivo_valore_5,
                    :obbiettivo_premio_5)");
        $stato = 0;
        if (isset($contrattino['stato'])) {
            $stato = $contrattino['stato'];
        }
        $stmt->bindParam('stato', $stato);
        $stmt->bindValue('id_cliente', $contrattino['id_cliente']);
        $stmt->bindValue('id_utente_crea', $contrattino['id_utente_crea']);
        $codice_fatturazione_totale = ((isset($contrattino['codice_fatturazione_totale'])) ? $contrattino['codice_fatturazione_totale'] : null);
        $codici_fatturazione = ((isset($contrattino['codici_fatturazione'])) ? $contrattino['codici_fatturazione'] : null);
        $liquidazione = ((isset($contrattino['liquidazione'])) ? $contrattino['liquidazione'] : null);
        $stmt->bindValue('codice_fatturazione_totale', $codice_fatturazione_totale);
        $stmt->bindValue('codici_fatturazione', $codici_fatturazione);
        $stmt->bindValue('liquidazione', $liquidazione);
        $stmt->bindValue('data_inserimento', $contrattino['data_inserimento']);
        $note_agente = ((isset($contrattino['note_agente'])) ? $contrattino['note_agente'] : null);
        $note_ispettore = ((isset($contrattino['note_ispettore'])) ? $contrattino['note_ispettore'] : null);
        $note_capoarea = ((isset($contrattino['note_capoarea'])) ? $contrattino['note_capoarea'] : null);
        $stmt->bindValue('note_agente', $note_agente);
        $stmt->bindValue('note_ispettore', $note_ispettore);
        $stmt->bindValue('note_capoarea', $note_capoarea);
        $stmt->bindValue('descrizione', isset($contrattino['descrizione']) ? $contrattino['descrizione'] : null);
        $stmt->bindValue('modalitadefinizioneobbiettivo', isset($contrattino['modalitadefinizioneobbiettivo']) ? intval($contrattino['modalitadefinizioneobbiettivo']) : null);
        $stmt->bindValue('modalitadefinizionepremio', isset($contrattino['modalitadefinizionepremio']) ? intval($contrattino['modalitadefinizionepremio']) : null);
        $stmt->bindValue('modalitaliquidazione', isset($contrattino['modalitaliquidazione']) ? intval($contrattino['modalitaliquidazione']) : null);
        $stmt->bindValue('tempisticadiliquidazione', isset($contrattino['tempisticadiliquidazione']) ? intval($contrattino['tempisticadiliquidazione']) : null);
        $stmt->bindValue('meseannoinizio', isset($contrattino['meseannoinizio']) ? $contrattino['meseannoinizio'] : null);
        $stmt->bindValue('meseannofine', isset($contrattino['meseannofine']) ? $contrattino['meseannofine'] : null);
        $stmt->bindValue('obbiettivo_valore_1', isset($contrattino['obbiettivo_valore_1']) ? intval($contrattino['obbiettivo_valore_1']) : null);
        $stmt->bindValue('obbiettivo_premio_1', isset($contrattino['obbiettivo_premio_1']) ? floatval($contrattino['obbiettivo_premio_1']) : null);
        $stmt->bindValue('obbiettivo_valore_2', isset($contrattino['obbiettivo_valore_2']) ? intval($contrattino['obbiettivo_valore_2']) : null);
        $stmt->bindValue('obbiettivo_premio_2', isset($contrattino['obbiettivo_premio_2']) ? floatval($contrattino['obbiettivo_premio_2']) : null);
        $stmt->bindValue('obbiettivo_valore_3', isset($contrattino['obbiettivo_valore_3']) ? intval($contrattino['obbiettivo_valore_3']) : null);
        $stmt->bindValue('obbiettivo_premio_3', isset($contrattino['obbiettivo_premio_3']) ? floatval($contrattino['obbiettivo_premio_3']) : null);
        $stmt->bindValue('obbiettivo_valore_4', isset($contrattino['obbiettivo_valore_4']) ? intval($contrattino['obbiettivo_valore_4']) : null);
        $stmt->bindValue('obbiettivo_premio_4', isset($contrattino['obbiettivo_premio_4']) ? floatval($contrattino['obbiettivo_premio_4']) : null);
        $stmt->bindValue('obbiettivo_valore_5', isset($contrattino['obbiettivo_valore_5']) ? intval($contrattino['obbiettivo_valore_5']) : null);
        $stmt->bindValue('obbiettivo_premio_5', isset($contrattino['obbiettivo_premio_5']) ? floatval($contrattino['obbiettivo_premio_5']) : null);

        $stmt->execute();

        $tipoContratto = $contrattino['tipo_contratto'];
        $id = $this->getPdo()->lastInsertId();
        $sql = "";
        if ($tipoContratto == 'FINEANNO') {
            $sql = "INSERT INTO CONTRATTO_PREMIOFINEANNO(
                    ID,
                    DIVISIONIDACONSIDERARE,
                    OBBIETTIVO_QUALIFICANTE_1,
                    OBBIETTIVO_QUALIFICANTE_2,
                    LIVELLO_OBBIETTIVO_1,
                    LIVELLO_OBBIETTIVO_2,
                    PERC_TARGET_TOTALE_OBB_QUALIFICANTE,
                    OBBIETTIVO_MINIMO_OBB_QUALIFICANTE,
                    PREMIO1_OBB_QUALIFICANTE,
                    TIPO1_OBB_QUALIFICANTE,
                    OBBIETTIVO_ULTERIORE_OBB_QUALIFICANTE,
                    PREMIO2_OBB_QUALIFICANTE,
                    TIPO2_OBB_QUALIFICANTE,
                    SUPERO1_TIPOOBBIETTIVO,
                    SUPERO1_OBBIETTIVI,
                    SUPERO1_PREMIO,
                    SUPERO1_TIPOPREMIO,
                    SUPERO2_TIPOOBBIETTIVO,
                    SUPERO2_OBBIETTIVI,
                    SUPERO2_PREMIO,
                    SUPERO2_TIPOPREMIO,
                    SUPERO3_TIPOOBBIETTIVO,
                    SUPERO3_OBBIETTIVI,
                    SUPERO3_PREMIO,
                    SUPERO3_TIPOPREMIO,
                    SUPERO4_TIPOOBBIETTIVO,
                    SUPERO4_OBBIETTIVI,
                    SUPERO4_PREMIO,
                    SUPERO4_TIPOPREMIO,
                    SUPERO5_TIPOOBBIETTIVO,
                    SUPERO5_OBBIETTIVI,
                    SUPERO5_PREMIO,
                    SUPERO5_TIPOPREMIO) VALUES (
                    :id,
                    :divisionidaconsiderare,
                    :obbiettivo_qualificante_1,
                    :obbiettivo_qualificante_2,
                    :livello_obbiettivo_1,
                    :livello_obbiettivo_2,
                    :perc_target_totale_obb_qualificante,
                    :obbiettivo_minimo_obb_qualificante,
                    :premio1_obb_qualificante,
                    :tipo1_obb_qualificante,
                    :obbiettivo_ulteriore_obb_qualificante,
                    :premio2_obb_qualificante,
                    :tipo2_obb_qualificante,
                    :supero1_tipoobbiettivo,
                    :supero1_obbiettivi,
                    :supero1_premio,
                    :supero1_tipopremio,
                    :supero2_tipoobbiettivo,
                    :supero2_obbiettivi,
                    :supero2_premio,
                    :supero2_tipopremio,
                    :supero3_tipoobbiettivo,
                    :supero3_obbiettivi,
                    :supero3_premio,
                    :supero3_tipopremio,
                    :supero4_tipoobbiettivo,
                    :supero4_obbiettivi,
                    :supero4_premio,
                    :supero4_tipopremio,
                    :supero5_tipoobbiettivo,
                    :supero5_obbiettivi,
                    :supero5_premio,
                    :supero5_tipopremio
                )";
        } else if ($tipoContratto == 'TARGETCLIENTISPECIALI') {
            $sql = "INSERT INTO contratto_target_clienti_speciali
                (ID,
                TCS_LIVELLO_OBBIETTIVO_1,
                TCS_OBBIETTIVO_1,
                TCS_LIVELLO_OBBIETTIVO_2,
                TCS_OBBIETTIVO_2,
                TCS_LIVELLO_OBBIETTIVO_3,
                TCS_OBBIETTIVO_3,
                TCS_LIVELLO_OBBIETTIVO_4,
                TCS_OBBIETTIVO_4,
                TCS_LIVELLO_OBBIETTIVO_5,
                TCS_OBBIETTIVO_5,
                TCS_SCONTO_FATTURA_1,
                TCS_SCONTO_FATTURA_2,
                TCS_SCONTO_FATTURA_3,
                TCS_SCONTO_FATTURA_4,
                TCS_SCONTO_FATTURA_5,
                TCS_CDC_1,
                TCS_CDC_2,
                TCS_CDC_3,
                TCS_CDC_4,
                TCS_CDC_5,
                TCS_FINEANNO_1,
                TCS_FINEANNO_2,
                TCS_FINEANNO_3,
                TCS_FINEANNO_4,
                TCS_FINEANNO_5)
                VALUES
                (
                :id,
                :tcs_livello_obbiettivo_1,
                :tcs_obbiettivo_1,
                :tcs_livello_obbiettivo_2,
                :tcs_obbiettivo_2,
                :tcs_livello_obbiettivo_3,
                :tcs_obbiettivo_3,
                :tcs_livello_obbiettivo_4,
                :tcs_obbiettivo_4,
                :tcs_livello_obbiettivo_5,
                :tcs_obbiettivo_5,
                :tcs_sconto_fattura_1,
                :tcs_sconto_fattura_2,
                :tcs_sconto_fattura_3,
                :tcs_sconto_fattura_4,
                :tcs_sconto_fattura_5,
                :tcs_cdc_1,
                :tcs_cdc_2,
                :tcs_cdc_3,
                :tcs_cdc_4,
                :tcs_cdc_5,
                :tcs_fineanno_1,
                :tcs_fineanno_2,
                :tcs_fineanno_3,
                :tcs_fineanno_4,
                :tcs_fineanno_5);";
        } else if (($tipoContratto == 'SERIJAKALA_PREMI') || ($tipoContratto == 'SERIJAKALA_PUNTI') || ($tipoContratto == 'SERIJAKALA_FATTURATO') || ($tipoContratto == 'GIRO')|| ($tipoContratto == 'JAKALAAREA1')|| ($tipoContratto == 'JAKALAAREA2')) {
            $sql = 'INSERT INTO contratto_serijakala
                        (
                        ID,
                        ID_FASCIA,
                        ID_PREMIO_INCREMENTO_FATTURATO,
                        ID_PREMIO_PUNTI_1,
                        ID_PREMIO_PUNTI_2,
                        ID_PREMIO_PUNTI_3,
                        ID_WAVE,
                        ID_FASCIA_ORDINE,
                        ID_INCREMENTO_FATTURATO)
                        VALUES
                        (
                        :id,
                        :id_fascia,
                        :id_premio_incremento_fatturato,
                        :id_premio_punti_1,
                        :id_premio_punti_2,
                        :id_premio_punti_3,
                        :id_wave,
                        :id_fascia_ordine,
                        :id_incremento_fatturato
                        );';
        } 
        $stmt = $this->getPdo()->prepare($sql);
        $this->createStatement($stmt, $contrattino, $id, $tipoContratto);
        $stmt->execute();
        return $this->readByID($id);
    }

    public function delete($id) {
        //NOP
    }

    public function read() {
        
    }

    public function readByUser($id_user,$filtro) {

        $stmt = $this->getPdo()->prepare(""
                . "SELECT * "
                . "FROM anagrafica_utente u "
                . "WHERE u.ID = :id "
        );
        $stmt->bindValue('id', $id_user);
        $stmt->execute();
        $res = $stmt->fetch();
        if ($res == null) {
            return null;
        }
        $ruolo = $res['ruolo'];
        $cod_dipendente = $res['cod_dipendente'];
        $field = null;
        $stati_contratti_attivi = array();
        $stati_contratti_da_firmare = array(1,2,3);
        $stati_contratti_fineciclo = array(6);
        $stati_contratti_da_approvare = array();
        
        switch ($ruolo) {
            case 'AGENTE' :
                $field = 'AGENTE';
                $stati_contratti_attivi = array(7,9);
                $stati_contratti_da_approvare = array(4,5,7,8,9);
                break;
            case 'ISPETTORE' :
                $field = 'COD_ISPETTORE';
                $stati_contratti_attivi = array(4,9);
                $stati_contratti_da_approvare = array(4,5,7,8,9);
                break;
            case 'CAPOAREA' :
                $field = 'COD_CAPO_AREA';
                $stati_contratti_attivi = array(4,5,8);
                $stati_contratti_da_approvare = array(4,5,7,8,9);
                break;
        }
        
        $sql = 'SELECT * FROM V_CONTRATTINI where id_cliente in (select id from anagrafica_cliente where ' . $field . ' = ?)';
        
        if ($filtro=='SOLOATTIVI'){
            $in  = str_repeat('?,', count($stati_contratti_attivi) - 1) . '?';
            $sql .= " AND STATO IN ($in)";
        } else if ($filtro=='DAFIRMARE'){
            $in  = str_repeat('?,', count($stati_contratti_da_firmare) - 1) . '?';
            $sql .= " AND STATO IN ($in)";
        } else if ($filtro=='FINECICLO'){
            $in  = str_repeat('?,', count($stati_contratti_fineciclo) - 1) . '?';
            $sql .= " AND STATO IN ($in)";
        } else if ($filtro=='DAAPPROVARE'){
            $in  = str_repeat('?,', count($stati_contratti_da_approvare) - 1) . '?';
            $sql .= " AND STATO IN ($in)";
        }
        

        //TBD: verificare anche se il contrattino e' stato modificato o creato dall'utente corrente?
        $stmt = $this->getPdo()->prepare($sql);
        $params = array($cod_dipendente);
        if ($filtro=='SOLOATTIVI'){
            $params = array_merge($params, $stati_contratti_attivi) ;
        } else if ($filtro=='DAFIRMARE'){
            $params = array_merge($params, $stati_contratti_da_firmare) ;
        } else if ($filtro=='FINECICLO'){
            $params = array_merge($params, $stati_contratti_fineciclo) ;
        } else if ($filtro=='DAAPPROVARE'){
            $params = array_merge($params, $stati_contratti_da_approvare) ;
        }
        $stmt->execute($params);
        $res = $stmt->fetchAll();
        return ($res);
    }

    public function update($contrattino) {
        $id = $contrattino['id'];
        $stmt = $this->getPdo()->prepare("UPDATE CONTRATTO_BASICDATA "
                . "SET DATA_AGGIORNAMENTO = now(),"
                . "ID_UTENTE_MOD = :id_utente_mod, "
                . "DESCRIZIONE = if (:descrizione  IS NULL,DESCRIZIONE, :descrizione),  "
                . "STATO =  if (:stato  IS NULL,STATO, :stato), "
                . "CODICE_FATTURAZIONE_TOTALE =  if (:codice_fatturazione_totale  IS NULL,CODICE_FATTURAZIONE_TOTALE, :codice_fatturazione_totale), "
                . "CODICI_FATTURAZIONE =  if (:codici_fatturazione  IS NULL,CODICI_FATTURAZIONE, :codici_fatturazione), "
                . "LIQUIDAZIONE =  if (:liquidazione  IS NULL,LIQUIDAZIONE, :liquidazione), "
                . "DATA_INSERIMENTO =  if (:data_inserimento  IS NULL,DATA_INSERIMENTO, :data_inserimento), "
                . "NOTEAGENTE =  if (:note_agente  IS NULL,NOTEAGENTE, :note_agente), "
                . "NOTEISPETTORE =  if (:note_ispettore  IS NULL,NOTEISPETTORE, :note_ispettore), "
                . "NOTECAPOAREA =  if (:note_capoarea  IS NULL,NOTECAPOAREA, :note_capoarea), " .
                "  modalitaliquidazione = if (:modalitaliquidazione  IS NULL,modalitaliquidazione, :modalitaliquidazione),
                    tempisticadiliquidazione = if (:tempisticadiliquidazione  IS NULL,tempisticadiliquidazione, :tempisticadiliquidazione),
                    meseannoinizio = if (:meseannoinizio  IS NULL,meseannoinizio, :meseannoinizio),
                    meseannofine = if (:meseannofine  IS NULL,meseannofine, :meseannofine),
                    modalitadefinizioneobbiettivo = if (:modalitadefinizioneobbiettivo  IS NULL,modalitadefinizioneobbiettivo, :modalitadefinizioneobbiettivo),
                    modalitadefinizionepremio = if (:modalitadefinizionepremio  IS NULL,modalitadefinizionepremio, :modalitadefinizionepremio),
                    obbiettivo_valore_1 = if (:obbiettivo_valore_1  IS NULL,obbiettivo_valore_1, :obbiettivo_valore_1),
                    obbiettivo_premio_1 = if (:obbiettivo_premio_1  IS NULL,obbiettivo_premio_1, :obbiettivo_premio_1),
                    obbiettivo_valore_2 = if (:obbiettivo_valore_2  IS NULL,obbiettivo_valore_2, :obbiettivo_valore_2),
                    obbiettivo_premio_2 = if (:obbiettivo_premio_2  IS NULL,obbiettivo_premio_2, :obbiettivo_premio_2),
                    obbiettivo_valore_3 = if (:obbiettivo_valore_3  IS NULL,obbiettivo_valore_3, :obbiettivo_valore_3),
                    obbiettivo_premio_3 = if (:obbiettivo_premio_3  IS NULL,obbiettivo_premio_3, :obbiettivo_premio_3),
                    obbiettivo_valore_4 = if (:obbiettivo_valore_4  IS NULL,obbiettivo_valore_4, :obbiettivo_valore_4),
                    obbiettivo_premio_4 = if (:obbiettivo_premio_4  IS NULL,obbiettivo_premio_4, :obbiettivo_premio_4),
                    obbiettivo_valore_5 = if (:obbiettivo_valore_5  IS NULL,obbiettivo_valore_5, :obbiettivo_valore_5),
                    obbiettivo_premio_5 = if (:obbiettivo_premio_5  IS NULL,obbiettivo_premio_5, :obbiettivo_premio_5) "
                . "WHERE ID=:id");
        $stmt->bindParam('id', $id);
        $stato = null;
        if (isset($contrattino['stato'])) {
            $stato = $contrattino['stato'];
        }
        $stmt->bindParam('stato', $stato);
        $stmt->bindParam('id_utente_mod', $contrattino['id_utente_mod']);
        
        $stmt->bindValue('descrizione', isset($contrattino['descrizione'])?$contrattino['descrizione']:'');
        $stmt->bindValue('codice_fatturazione_totale', isset($contrattino['codice_fatturazione_totale'])?$contrattino['codice_fatturazione_totale']:'');
        $stmt->bindValue('codici_fatturazione', isset($contrattino['codici_fatturazione'])?$contrattino['codici_fatturazione']:'');
        $stmt->bindValue('liquidazione', isset($contrattino['liquidazione'])?intval($contrattino['liquidazione']):null);
        $stmt->bindValue('data_inserimento', isset($contrattino['data_inserimento'])?$contrattino['data_inserimento']:null);
        $note_agente = ((isset($contrattino['note_agente'])) ? $contrattino['note_agente'] : null);
        $note_ispettore = ((isset($contrattino['note_ispettore'])) ? $contrattino['note_ispettore'] : null);
        $note_capoarea = ((isset($contrattino['note_capoarea'])) ? $contrattino['note_capoarea'] : null);
        $stmt->bindValue('note_agente', $note_agente);
        $stmt->bindValue('note_ispettore', $note_ispettore);
        $stmt->bindValue('note_capoarea', $note_capoarea);
        $stmt->bindValue('modalitadefinizioneobbiettivo', isset($contrattino['modalitadefinizioneobbiettivo']) ? intval($contrattino['modalitadefinizioneobbiettivo']) : null);
        $stmt->bindValue('modalitadefinizionepremio', isset($contrattino['modalitadefinizionepremio']) ? intval($contrattino['modalitadefinizionepremio']) : null);
        $stmt->bindValue('modalitaliquidazione', isset($contrattino['modalitaliquidazione']) ? intval($contrattino['modalitaliquidazione']) : null);
        $stmt->bindValue('tempisticadiliquidazione', isset($contrattino['tempisticadiliquidazione']) ? intval($contrattino['tempisticadiliquidazione']) : null);
        $stmt->bindValue('meseannoinizio', isset($contrattino['meseannoinizio']) ? $contrattino['meseannoinizio'] : null);
        $stmt->bindValue('meseannofine', isset($contrattino['meseannofine']) ? $contrattino['meseannofine'] : null);
        $stmt->bindValue('obbiettivo_valore_1', isset($contrattino['obbiettivo_valore_1']) ? intval($contrattino['obbiettivo_valore_1']) : null);
        $stmt->bindValue('obbiettivo_premio_1', isset($contrattino['obbiettivo_premio_1']) ? floatval($contrattino['obbiettivo_premio_1']) : null);
        $stmt->bindValue('obbiettivo_valore_2', isset($contrattino['obbiettivo_valore_2']) ? intval($contrattino['obbiettivo_valore_2']) : null);
        $stmt->bindValue('obbiettivo_premio_2', isset($contrattino['obbiettivo_premio_2']) ? floatval($contrattino['obbiettivo_premio_2']) : null);
        $stmt->bindValue('obbiettivo_valore_3', isset($contrattino['obbiettivo_valore_3']) ? intval($contrattino['obbiettivo_valore_3']) : null);
        $stmt->bindValue('obbiettivo_premio_3', isset($contrattino['obbiettivo_premio_3']) ? floatval($contrattino['obbiettivo_premio_3']) : null);
        $stmt->bindValue('obbiettivo_valore_4', isset($contrattino['obbiettivo_valore_4']) ? intval($contrattino['obbiettivo_valore_4']) : null);
        $stmt->bindValue('obbiettivo_premio_4', isset($contrattino['obbiettivo_premio_4']) ? floatval($contrattino['obbiettivo_premio_4']) : null);
        $stmt->bindValue('obbiettivo_valore_5', isset($contrattino['obbiettivo_valore_5']) ? intval($contrattino['obbiettivo_valore_5']) : null);
        $stmt->bindValue('obbiettivo_premio_5', isset($contrattino['obbiettivo_premio_5']) ? floatval($contrattino['obbiettivo_premio_5']) : null);

        $stmt->execute();
        $tipoContratto = $this->readByID($id)[0]['tipo_contratto'];
        $sql = '';
        if ($tipoContratto == 'FINEANNO') {
            $sql = "     
                UPDATE 
                    contratto_premiofineanno
                SET
                    divisionidaconsiderare = if (:divisionidaconsiderare  IS NULL,divisionidaconsiderare, :divisionidaconsiderare),
                    obbiettivo_qualificante_1 = if (:obbiettivo_qualificante_1  IS NULL,obbiettivo_qualificante_1, :obbiettivo_qualificante_1),
                    obbiettivo_qualificante_2 = if (:obbiettivo_qualificante_2  IS NULL,obbiettivo_qualificante_2, :obbiettivo_qualificante_2),
                    livello_obbiettivo_1 = if (:livello_obbiettivo_1  IS NULL,livello_obbiettivo_1, :livello_obbiettivo_1),
                    livello_obbiettivo_2 = if (:livello_obbiettivo_2  IS NULL,livello_obbiettivo_2, :livello_obbiettivo_2),
                    perc_target_totale_obb_qualificante = if (:perc_target_totale_obb_qualificante  IS NULL,perc_target_totale_obb_qualificante, :perc_target_totale_obb_qualificante),
                    obbiettivo_minimo_obb_qualificante = if (:obbiettivo_minimo_obb_qualificante  IS NULL,obbiettivo_minimo_obb_qualificante, :obbiettivo_minimo_obb_qualificante),
                    premio1_obb_qualificante = if (:premio1_obb_qualificante  IS NULL,premio1_obb_qualificante, :premio1_obb_qualificante),
                    tipo1_obb_qualificante = if (:tipo1_obb_qualificante  IS NULL,tipo1_obb_qualificante, :tipo1_obb_qualificante),
                    obbiettivo_ulteriore_obb_qualificante = if (:obbiettivo_ulteriore_obb_qualificante  IS NULL,obbiettivo_ulteriore_obb_qualificante, :obbiettivo_ulteriore_obb_qualificante),
                    premio2_obb_qualificante = if (:premio2_obb_qualificante  IS NULL,premio2_obb_qualificante, :premio2_obb_qualificante),
                    tipo2_obb_qualificante = if (:tipo2_obb_qualificante  IS NULL,tipo2_obb_qualificante, :tipo2_obb_qualificante),
                    supero1_tipoobbiettivo = if (:supero1_tipoobbiettivo  IS NULL,supero1_tipoobbiettivo, :supero1_tipoobbiettivo),
                    supero1_obbiettivi = if (:supero1_obbiettivi  IS NULL,supero1_obbiettivi, :supero1_obbiettivi),
                    supero1_premio = if (:supero1_premio  IS NULL,supero1_premio, :supero1_premio),
                    supero1_tipopremio = if (:supero1_tipopremio  IS NULL,supero1_tipopremio, :supero1_tipopremio),
                    supero2_tipoobbiettivo = if (:supero2_tipoobbiettivo  IS NULL,supero2_tipoobbiettivo, :supero2_tipoobbiettivo),
                    supero2_obbiettivi = if (:supero2_obbiettivi  IS NULL,supero2_obbiettivi, :supero2_obbiettivi),
                    supero2_premio = if (:supero2_premio  IS NULL,supero2_premio, :supero2_premio),
                    supero2_tipopremio = if (:supero2_tipopremio  IS NULL,supero2_tipopremio, :supero2_tipopremio),
                    supero3_tipoobbiettivo = if (:supero3_tipoobbiettivo  IS NULL,supero3_tipoobbiettivo, :supero3_tipoobbiettivo),
                    supero3_obbiettivi = if (:supero3_obbiettivi  IS NULL,supero3_obbiettivi, :supero3_obbiettivi),
                    supero3_premio = if (:supero3_premio  IS NULL,supero3_premio, :supero3_premio),
                    supero3_tipopremio = if (:supero3_tipopremio  IS NULL,supero3_tipopremio, :supero3_tipopremio),
                    supero4_tipoobbiettivo = if (:supero4_tipoobbiettivo  IS NULL,supero4_tipoobbiettivo, :supero4_tipoobbiettivo),
                    supero4_obbiettivi = if (:supero4_obbiettivi  IS NULL,supero4_obbiettivi, :supero4_obbiettivi),
                    supero4_premio = if (:supero4_premio  IS NULL,supero4_premio, :supero4_premio),
                    supero4_tipopremio = if (:supero4_tipopremio  IS NULL,supero4_tipopremio, :supero4_tipopremio),
                    supero5_tipoobbiettivo = if (:supero5_tipoobbiettivo  IS NULL,supero5_tipoobbiettivo, :supero5_tipoobbiettivo),
                    supero5_obbiettivi = if (:supero5_obbiettivi  IS NULL,supero5_obbiettivi, :supero5_obbiettivi),
                    supero5_premio = if (:supero5_premio  IS NULL,supero5_premio, :supero5_premio),
                    supero5_tipopremio = if (:supero5_tipopremio,supero5_tipopremio,:supero5_tipopremio )
                WHERE id = :id";
        } else if ($tipoContratto == "TARGETCLIENTISPECIALI") {
            $sql = "
                UPDATE 
                    contratto_target_clienti_speciali
                SET
                    tcs_livello_obbiettivo_1 = if (:tcs_livello_obbiettivo_1  IS NULL,tcs_livello_obbiettivo_1, :tcs_livello_obbiettivo_1),
                    tcs_obbiettivo_1 = if (:tcs_obbiettivo_1  IS NULL,tcs_obbiettivo_1, :tcs_obbiettivo_1),
                    tcs_livello_obbiettivo_2 = if (:tcs_livello_obbiettivo_2  IS NULL,tcs_livello_obbiettivo_2, :tcs_livello_obbiettivo_2),
                    tcs_obbiettivo_2 = if (:tcs_obbiettivo_2  IS NULL,tcs_obbiettivo_2, :tcs_obbiettivo_2),
                    tcs_livello_obbiettivo_3 = if (:tcs_livello_obbiettivo_3  IS NULL,tcs_livello_obbiettivo_3, :tcs_livello_obbiettivo_3),
                    tcs_obbiettivo_4 = if (:tcs_obbiettivo_4  IS NULL,tcs_obbiettivo_4, :tcs_obbiettivo_4),
                    tcs_livello_obbiettivo_4 = if (:tcs_livello_obbiettivo_4  IS NULL,tcs_livello_obbiettivo_4, :tcs_livello_obbiettivo_4),
                    tcs_obbiettivo_5 = if (:tcs_obbiettivo_5  IS NULL,tcs_obbiettivo_5, :tcs_obbiettivo_5),
                    tcs_livello_obbiettivo_5 = if (:tcs_livello_obbiettivo_5  IS NULL,tcs_livello_obbiettivo_5, :tcs_livello_obbiettivo_5),

                    tcs_sconto_fattura_1 = if (:tcs_sconto_fattura_1  IS NULL,tcs_sconto_fattura_1, :tcs_sconto_fattura_1),
                    tcs_sconto_fattura_2 = if (:tcs_sconto_fattura_2  IS NULL,tcs_sconto_fattura_2, :tcs_sconto_fattura_2),
                    tcs_sconto_fattura_3 = if (:tcs_sconto_fattura_3  IS NULL,tcs_sconto_fattura_3, :tcs_sconto_fattura_3),
                    tcs_sconto_fattura_4 = if (:tcs_sconto_fattura_4  IS NULL,tcs_sconto_fattura_4, :tcs_sconto_fattura_4),
                    tcs_sconto_fattura_5 = if (:tcs_sconto_fattura_5  IS NULL,tcs_sconto_fattura_5, :tcs_sconto_fattura_5),

                    tcs_cdc_1 = if (:tcs_cdc_1  IS NULL,tcs_cdc_1, :tcs_cdc_1),
                    tcs_cdc_2 = if (:tcs_cdc_2  IS NULL,tcs_cdc_2, :tcs_cdc_2),
                    tcs_cdc_3 = if (:tcs_cdc_3  IS NULL,tcs_cdc_3, :tcs_cdc_3),
                    tcs_cdc_4 = if (:tcs_cdc_4  IS NULL,tcs_cdc_4, :tcs_cdc_4),
                    tcs_cdc_5 = if (:tcs_cdc_5  IS NULL,tcs_cdc_5, :tcs_cdc_5),

                    tcs_fineanno_1 = if (:tcs_fineanno_1  IS NULL,tcs_fineanno_1, :tcs_fineanno_1),
                    tcs_fineanno_2 = if (:tcs_fineanno_2  IS NULL,tcs_fineanno_2, :tcs_fineanno_2),
                    tcs_fineanno_3 = if (:tcs_fineanno_3  IS NULL,tcs_fineanno_3, :tcs_fineanno_3),
                    tcs_fineanno_4 = if (:tcs_fineanno_4  IS NULL,tcs_fineanno_4, :tcs_fineanno_4),
                    tcs_fineanno_5 = if (:tcs_fineanno_5  IS NULL,tcs_fineanno_5, :tcs_fineanno_5)
                WHERE id = :id";

        } else if (($tipoContratto == 'SERIJAKALA_PREMI') ||($tipoContratto == 'SERIJAKALA_PUNTI') || ($tipoContratto == 'SERIJAKALA_FATTURATO')
        || ($tipoContratto == "JAKALAAREA1")|| ($tipoContratto == "JAKALAAREA2")
        ) {
            $sql = "
                UPDATE 
                    contratto_serijakala
                SET
                    id_fascia = if (:id_fascia  IS NULL,id_fascia, :id_fascia),
                    id_premio_incremento_fatturato = if (:id_premio_incremento_fatturato  IS NULL,id_premio_incremento_fatturato, :id_premio_incremento_fatturato),
                    id_premio_punti_1 = if (:id_premio_punti_1  IS NULL,id_premio_punti_1, :id_premio_punti_1),
                    id_premio_punti_2 = if (:id_premio_punti_2  IS NULL,id_premio_punti_2, :id_premio_punti_2),
                    id_premio_punti_3 = if (:id_premio_punti_3  IS NULL,id_premio_punti_3, :id_premio_punti_3),
                    id_fascia = if (:id_fascia  IS NULL,id_fascia, :id_fascia),
                    id_incremento_fatturato = if (:id_incremento_fatturato  IS NULL,id_incremento_fatturato, :id_incremento_fatturato),
                    id_wave = if (:id_wave  IS NULL,id_wave, :id_wave)
                WHERE id = :id";
            
        }
        $stmt = $this->getPdo()->prepare($sql);
        $this->createStatement($stmt, $contrattino, $id, $tipoContratto);
        $stmt->execute();
        return $this->readByID($id);
    }

    public function readByID($id) {
        $sql = "SELECT * FROM V_CONTRATTINI WHERE ID=:id";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

    private function createStatement($stmt, $contrattino, $id, $tipoContratto) {

        ini_set('display_errors', '0');
        $stmt->bindValue('id', $id);

        if ($tipoContratto == "FINEANNO") {
            $stmt->bindValue('divisionidaconsiderare', isset($contrattino['divisionidaconsiderare']) ? $contrattino['divisionidaconsiderare'] : null);
            $stmt->bindValue('obbiettivo_qualificante_1', isset($contrattino['obbiettivo_qualificante_1']) ? $contrattino['obbiettivo_qualificante_1'] : null);
            $stmt->bindValue('obbiettivo_qualificante_2', isset($contrattino['obbiettivo_qualificante_2']) ? $contrattino['obbiettivo_qualificante_2'] : null);
            $stmt->bindValue('livello_obbiettivo_1', isset($contrattino['livello_obbiettivo_1']) ? intval($contrattino['livello_obbiettivo_1']) : null);
            $stmt->bindValue('livello_obbiettivo_2', isset($contrattino['livello_obbiettivo_2']) ? intval($contrattino['livello_obbiettivo_2']) : null);
            $stmt->bindValue('perc_target_totale_obb_qualificante', isset($contrattino['perc_target_totale_obb_qualificante']) ? floatval($contrattino['perc_target_totale_obb_qualificante']) : null);
            $stmt->bindValue('obbiettivo_minimo_obb_qualificante', isset($contrattino['obbiettivo_minimo_obb_qualificante']) ? $contrattino['obbiettivo_minimo_obb_qualificante'] : null);
            $stmt->bindValue('premio1_obb_qualificante', isset($contrattino['premio1_obb_qualificante']) ? $contrattino['premio1_obb_qualificante'] : null);
            $stmt->bindValue('tipo1_obb_qualificante', isset($contrattino['tipo1_obb_qualificante']) ? $contrattino['tipo1_obb_qualificante'] : null);
            $stmt->bindValue('obbiettivo_ulteriore_obb_qualificante', isset($contrattino['obbiettivo_ulteriore_obb_qualificante']) ? $contrattino['obbiettivo_ulteriore_obb_qualificante'] : null);
            $stmt->bindValue('premio2_obb_qualificante', isset($contrattino['premio2_obb_qualificante']) ? $contrattino['premio2_obb_qualificante'] : null);
            $stmt->bindValue('tipo2_obb_qualificante', isset($contrattino['tipo2_obb_qualificante']) ? $contrattino['tipo2_obb_qualificante'] : null);
            $stmt->bindValue('supero1_tipoobbiettivo', isset($contrattino['supero1_tipoobbiettivo']) ? $contrattino['supero1_tipoobbiettivo'] : null);
            $stmt->bindValue('supero1_obbiettivi', isset($contrattino['supero1_obbiettivi']) ? $contrattino['supero1_obbiettivi'] : null);
            $stmt->bindValue('supero1_premio', isset($contrattino['supero1_premio']) ? $contrattino['supero1_premio'] : null);
            $stmt->bindValue('supero1_tipopremio', isset($contrattino['supero1_tipopremio']) ? $contrattino['supero1_tipopremio'] : null);
            $stmt->bindValue('supero2_tipoobbiettivo', isset($contrattino['supero2_tipoobbiettivo']) ? $contrattino['supero2_tipoobbiettivo'] : null);
            $stmt->bindValue('supero2_obbiettivi', isset($contrattino['supero2_obbiettivi']) ? $contrattino['supero2_obbiettivi'] : null);
            $stmt->bindValue('supero2_premio', isset($contrattino['supero2_premio']) ? $contrattino['supero2_premio'] : null);
            $stmt->bindValue('supero2_tipopremio', isset($contrattino['supero2_tipopremio']) ? $contrattino['supero2_tipopremio'] : null);
            $stmt->bindValue('supero3_tipoobbiettivo', isset($contrattino['supero3_tipoobbiettivo']) ? $contrattino['supero3_tipoobbiettivo'] : null);
            $stmt->bindValue('supero3_obbiettivi', isset($contrattino['supero3_obbiettivi']) ? $contrattino['supero3_obbiettivi'] : null);
            $stmt->bindValue('supero3_premio', isset($contrattino['supero3_premio']) ? $contrattino['supero3_premio'] : null);
            $stmt->bindValue('supero3_tipopremio', isset($contrattino['supero3_tipopremio']) ? $contrattino['supero3_tipopremio'] : null);
            $stmt->bindValue('supero4_tipoobbiettivo', isset($contrattino['supero4_tipoobbiettivo']) ? $contrattino['supero4_tipoobbiettivo'] : null);
            $stmt->bindValue('supero4_obbiettivi', isset($contrattino['supero4_obbiettivi']) ? $contrattino['supero4_obbiettivi'] : null);
            $stmt->bindValue('supero4_premio', isset($contrattino['supero4_premio']) ? $contrattino['supero4_premio'] : null);
            $stmt->bindValue('supero4_tipopremio', isset($contrattino['supero4_tipopremio']) ? $contrattino['supero4_tipopremio'] : null);
            $stmt->bindValue('supero5_tipoobbiettivo', isset($contrattino['supero5_tipoobbiettivo']) ? $contrattino['supero5_tipoobbiettivo'] : null);
            $stmt->bindValue('supero5_obbiettivi', isset($contrattino['supero5_obbiettivi']) ? $contrattino['supero5_obbiettivi'] : null);
            $stmt->bindValue('supero5_premio', isset($contrattino['supero5_premio']) ? $contrattino['supero5_premio'] : null);
            $stmt->bindValue('supero5_tipopremio', isset($contrattino['supero5_tipopremio']) ? $contrattino['supero5_tipopremio'] : null);
        } else if ($tipoContratto == "TARGETCLIENTISPECIALI") {
            $stmt->bindParam("tcs_livello_obbiettivo_1", isset($contrattino['tcs_livello_obbiettivo_1']) ? $contrattino['tcs_livello_obbiettivo_1'] : null);
            $stmt->bindParam("tcs_obbiettivo_1", isset($contrattino['tcs_obbiettivo_1']) ? $contrattino['tcs_obbiettivo_1'] : null);
            $stmt->bindParam("tcs_livello_obbiettivo_2", isset($contrattino['tcs_livello_obbiettivo_2']) ? $contrattino['tcs_livello_obbiettivo_2'] : null);
            $stmt->bindParam("tcs_obbiettivo_2", isset($contrattino['tcs_obbiettivo_2']) ? $contrattino['tcs_obbiettivo_2'] : null);
            $stmt->bindParam("tcs_livello_obbiettivo_3", isset($contrattino['tcs_livello_obbiettivo_3']) ? $contrattino['tcs_livello_obbiettivo_3'] : null);
            $stmt->bindParam("tcs_obbiettivo_3", isset($contrattino['tcs_obbiettivo_3']) ? $contrattino['tcs_obbiettivo_3'] : null);
            $stmt->bindParam("tcs_livello_obbiettivo_4", isset($contrattino['tcs_livello_obbiettivo_4']) ? $contrattino['tcs_livello_obbiettivo_4'] : null);
            $stmt->bindParam("tcs_obbiettivo_4", isset($contrattino['tcs_obbiettivo_4']) ? $contrattino['tcs_obbiettivo_4'] : null);
            $stmt->bindParam("tcs_livello_obbiettivo_5", isset($contrattino['tcs_livello_obbiettivo_5']) ? $contrattino['tcs_livello_obbiettivo_5'] : null);
            $stmt->bindParam("tcs_obbiettivo_5", isset($contrattino['tcs_obbiettivo_5']) ? $contrattino['tcs_obbiettivo_5'] : null);
            $stmt->bindParam("tcs_cdc_1", isset($contrattino['tcs_cdc_1']) ? $contrattino['tcs_cdc_1'] : null);
            $stmt->bindParam("tcs_cdc_2", isset($contrattino['tcs_cdc_2']) ? $contrattino['tcs_cdc_2'] : null);
            $stmt->bindParam("tcs_cdc_3", isset($contrattino['tcs_cdc_3']) ? $contrattino['tcs_cdc_3'] : null);
            $stmt->bindParam("tcs_cdc_4", isset($contrattino['tcs_cdc_4']) ? $contrattino['tcs_cdc_4'] : null);
            $stmt->bindParam("tcs_cdc_5", isset($contrattino['tcs_cdc_5']) ? $contrattino['tcs_cdc_5'] : null);
            $stmt->bindParam("tcs_fineanno_1", isset($contrattino['tcs_fineanno_1']) ? $contrattino['tcs_fineanno_1'] : null);
            $stmt->bindParam("tcs_fineanno_2", isset($contrattino['tcs_fineanno_2']) ? $contrattino['tcs_fineanno_2'] : null);
            $stmt->bindParam("tcs_fineanno_3", isset($contrattino['tcs_fineanno_3']) ? $contrattino['tcs_fineanno_3'] : null);
            $stmt->bindParam("tcs_fineanno_4", isset($contrattino['tcs_fineanno_4']) ? $contrattino['tcs_fineanno_4'] : null);
            $stmt->bindParam("tcs_fineanno_5", isset($contrattino['tcs_fineanno_5']) ? $contrattino['tcs_fineanno_5'] : null);
            $stmt->bindParam("tcs_fineanno_1", isset($contrattino['tcs_fineanno_1']) ? $contrattino['tcs_fineanno_1'] : null);
            $stmt->bindParam("tcs_fineanno_2", isset($contrattino['tcs_fineanno_2']) ? $contrattino['tcs_fineanno_2'] : null);
            $stmt->bindParam("tcs_fineanno_3", isset($contrattino['tcs_fineanno_3']) ? $contrattino['tcs_fineanno_3'] : null);
            $stmt->bindParam("tcs_fineanno_4", isset($contrattino['tcs_fineanno_4']) ? $contrattino['tcs_fineanno_4'] : null);
            $stmt->bindParam("tcs_fineanno_5", isset($contrattino['tcs_fineanno_5']) ? $contrattino['tcs_fineanno_5'] : null);
            $stmt->bindParam("tcs_sconto_fattura_1", isset($contrattino['tcs_sconto_fattura_1']) ? $contrattino['tcs_sconto_fattura_1'] : null);
            $stmt->bindParam("tcs_sconto_fattura_2", isset($contrattino['tcs_sconto_fattura_2']) ? $contrattino['tcs_sconto_fattura_2'] : null);
            $stmt->bindParam("tcs_sconto_fattura_3", isset($contrattino['tcs_sconto_fattura_3']) ? $contrattino['tcs_sconto_fattura_3'] : null);
            $stmt->bindParam("tcs_sconto_fattura_4", isset($contrattino['tcs_sconto_fattura_4']) ? $contrattino['tcs_sconto_fattura_4'] : null);
            $stmt->bindParam("tcs_sconto_fattura_5", isset($contrattino['tcs_sconto_fattura_5']) ? $contrattino['tcs_sconto_fattura_5'] : null);
        } else if (($tipoContratto == "GIRO") || ($tipoContratto == "SERIJAKALA_PREMI") || ($tipoContratto == "SERIJAKALA_PUNTI") || (($tipoContratto == "SERIJAKALA_FATTURATO"))|| (($tipoContratto == "JAKALAAREA1"))|| (($tipoContratto == "JAKALAAREA2"))){
            $stmt->bindParam("id_fascia", isset($contrattino['id_fascia']) ? $contrattino['id_fascia'] : null);
            $stmt->bindParam("id_premio_incremento_fatturato", isset($contrattino['id_premio_incremento_fatturato']) ? $contrattino['id_premio_incremento_fatturato'] : null);
            if (($tipoContratto == "GIRO") ){
                $stmt->bindParam("id_premio_punti_1", isset($contrattino['id_kit']) ? $contrattino['id_kit'] : null);
            } else {
                $stmt->bindParam("id_premio_punti_1", isset($contrattino['id_premio_punti_1']) ? $contrattino['id_premio_punti_1'] : null);
            }
            $stmt->bindParam("id_premio_punti_2", isset($contrattino['id_premio_punti_2']) ? $contrattino['id_premio_punti_2'] : null);
            $stmt->bindParam("id_premio_punti_3", isset($contrattino['id_premio_punti_3']) ? $contrattino['id_premio_punti_3'] : null);
            $stmt->bindParam("id_wave", isset($contrattino['id_wave']) ? $contrattino['id_wave'] : null);
            $stmt->bindParam("id_fascia_ordine", isset($contrattino['id_fascia_ordine']) ? $contrattino['id_fascia_ordine'] : null);
            $stmt->bindParam("id_incremento_fatturato", isset($contrattino['id_incremento_fatturato']) ? $contrattino['id_incremento_fatturato'] : null);
        } 
        ini_set('display_errors', '1');
    }

}