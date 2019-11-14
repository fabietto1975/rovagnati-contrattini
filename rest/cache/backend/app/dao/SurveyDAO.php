<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class SurveyDAO__AopProxied extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    } 

    public function create($item) {
        //NOP
    }

    public function delete($id) {
        //NOP
    }

    public function read() {
    }

    public function update($item) {
         //NOP
    }
  
    public function readWaveCorrente() {
        $sql = "SELECT *
                FROM survey_wave
                WHERE DATA_INIZIO <= NOW() AND DATA_FINE > NOW()";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function readDomandeCliente($id_profilo, $id_wave, $id_cliente) {    
        $sql = "SELECT D.id as ID_DOMANDA,
                       D.area, D.ordine_area, d.ordine, d.testo, d.tipo, 
                       d.valori_risposta,  d.id_profilo, w.id_wave as id_wave, '' as id_risposta, '' as valore_risposta, '' as id_valore_risposta
                FROM survey_domanda D LEFT JOIN survey_wave_domanda W ON D.ID = W.ID_DOMANDA
                WHERE D.ID_PROFILO = :id_profilo AND W.ID_WAVE <= :id_wave 
                    AND d.id not in (select id_domanda from survey_risposta where id_cliente = :id_cliente) 
                    
                UNION
                
                select D.id as ID_DOMANDA,
                       D.area, D.ordine_area, d.ordine, d.testo, d.tipo, 
                       d.valori_risposta,  d.id_profilo, r.id_wave as id_wave, r.id as id_risposta, r.valore_risposta as valore_risposta, r.id_risposta as id_valore_risposta
                FROM survey_risposta r join survey_domanda d on (r.id_domanda = d.id)
                WHERE ID_CLIENTE = :id_cliente
                ";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_profilo', $id_profilo);
        $stmt->bindParam('id_wave', $id_wave);
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /*
    public function readRisposteCliente($id_cliente) {       
        $sql = "select D.id as ID_DOMANDA,
                       D.area, D.ordine_area, d.testo, d.ordine, d.testo, d.tipo, 
                       d.valori_risposta,  d. id_profilo, r.id_wave as id_wave, r.id as id_risposta, r.valore_risposta as valore_risposta, r.id_risposta as id_valore_risposta
                FROM survey_risposta r join survey_domanda d on (r.id_domanda = d.id)
                WHERE ID_CLIENTE = :id_cliente
                 ORDER BY D.ordine_area, d.ordine";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll();
    }
     * 
     */

    public function readByID($id) {       
        $sql = "SELECT *
                FROM survey_risposta
                WHERE ID = :id";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\SurveyDAO.php';

