<?php

namespace backend\app\service;

use backend\app\dao\SurveyDAO;

class SurveyService {

    private $surveyDAO;

    public function __construct() {
        $this->surveyDAO = new SurveyDAO();
    }
    
    public function read(){}
    
    public function createRisposta($parameters) {       
        $id_domanda = $parameters['id_domanda'];
        $id_cliente = $parameters['id_cliente'];
        $valore_risposta = $parameters['valore_risposta'];
        $id_utente = $parameters['id_utente'];
        $id_wave = $parameters['id_wave'];
        
        $res = $this->surveyDAO->createRisposta($id_domanda, $id_cliente, $valore_risposta, $id_utente, $id_wave);
        
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'la risposta non è stata scritta correttamente',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
    }
    
    public function updateRisposta($parameters) {
        $id = $parameters['id'];
        $valore_risposta = $parameters['valore_risposta'];
        
        $res = $this->surveyDAO->updateRisposta($id, $valore_risposta);
        
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'la risposta non è stata aggiornata correttamente',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
    }
    
    public function readWaveCorrente(){
        $res = $this->surveyDAO->readWaveCorrente();
        
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'wave corrente non trovata',
                'error' => 'NO_DATA'
            );
        } 
        if (count($res) != 1){
            return array(
                'status' => 'fail',
                'message' => 'al momento non è attiva una sola wave',
                'error' => 'INVALID_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }
    
    public function readDomandeRisposteCliente ($id_cliente, $id_profilo, $id_wave) {
        $res = $this->surveyDAO->readDomandeCliente($id_profilo, $id_wave, $id_cliente);
        //$res_r = $this->surveyDAO->readRisposteCliente($id_cliente);
        
        //$res = Array( "domande" => $res_d, "risposte" => $res_r );
        //$res = array_merge($res_d, $res_r);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'domande survey non trovate',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
    }

    

}
