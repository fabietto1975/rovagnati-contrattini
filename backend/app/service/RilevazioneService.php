<?php

namespace backend\app\service;

use backend\app\dao\RilevazioneDAO;

class RilevazioneService {

    private $rilevazioneDAO;

    public function __construct() {
        $this->rilevazioneDAO = new RilevazioneDAO();
    }
    
        
    public function create($parameters){
        $res = $this->rilevazioneDAO->create($parameters);
        if ($res['status']=='KO'){
            return array(
                'status' => 'fail',
                'message' => 'errore nella scrittura dei dati',
                'error' => $res['message']
            );
            
        } else {
            $rilevazione = $this->readRilevazione( $parameters['rilevazione'][0]['id_rilevazione'], $parameters['rilevazione'][0]['id_cliente']);
            return array(
                'status' => 'success',
                'res' => $rilevazione['res']
            );
            
        }
        
    }

    public function readProdotto($id_prodotto){
        $res = $this->rilevazioneDAO->readProdotto($id_prodotto);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'errore nella lettura dei dati',
                'error' => $res['message']
            );
            
        } else {
            return array(
                'status' => 'success',
                'res' => $res
            );
            
        }
        
    }


    public function createProdotto($parameters,$id_punto_vendita,$id_rilevazione){
        $res = $this->rilevazioneDAO->createProdotto($parameters,$id_punto_vendita,$id_rilevazione);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'errore nella scrittura dei dati',
                'error' => $res['message']
            );
            
        } else {
            return array(
                'status' => 'success',
                'res' => $res
            );
            
        }
        
    }

    public function updateProdotto($parameters,$id_informazioni_prodotto){
        $res = $this->rilevazioneDAO->updateProdotto($parameters,$id_informazioni_prodotto);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'errore nella scrittura dei dati',
                'error' => $res['message']
            );
            
        } else {
            return array(
                'status' => 'success',
                'res' => $res
            );
            
        }
        
    }

    public function deleteProdotto($id_informazioni_prodotto){
        $res = $this->rilevazioneDAO->deleteProdotto($id_informazioni_prodotto);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'errore nella scrittura dei dati',
                'error' => $res['message']
            );
            
        } else {
            return array(
                'status' => 'success',
                'res' => $res
            );
            
        }
        
    }

    
    
    public function update($parameters){
        $res = $this->rilevazioneDAO->update($parameters);
        if ($res['status']=='KO'){
            return array(
                'status' => 'fail',
                'message' => 'errore nella scrittura dei dati',
                'error' => $res['message']
            );
            
        } else {
            $rilevazione = $this->readRilevazione( $parameters['rilevazione'][0]['id_rilevazione'], $parameters['rilevazione'][0]['id_cliente']);
            return array(
                'status' => 'success',
                'res' =>  $rilevazione['res']
            );
            
        }
        
        
    }

    public function readRilevazioneInCorso(){
        $res = $this->rilevazioneDAO->readRilevazioneInCorso();
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessuna rilevazione attiva',
                'error' => 'NO_DATA'
            );
        } else if (count($res)>1){
            return array(
                'status' => 'fail',
                'message' => 'piu di una rilevazione attiva',
                'error' => 'DATA_ERROR'
            );
        } 
        return array(
            'res' => $res[0] ,
            'status' => 'success'
        );
        
    }

    public function readRilevazione($id_rilevazione, $id_punto_vendita){
        $res = $this->rilevazioneDAO->readRilevazione($id_rilevazione, $id_punto_vendita);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessuna rilevazione attiva',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res ,
            'status' => 'success'
        );
        
        
    }
    
    

}
