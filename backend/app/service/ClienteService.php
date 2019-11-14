<?php

namespace backend\app\service;

use backend\app\dao\ClienteDAO;

class ClienteService {

    private $clienteDAO;
    private $waveSeriJakalaService;
    public function __construct() {
        $this->clienteDAO = new ClienteDAO();
        $this->waveSeriJakalaService = new WaveSeriJakalaService();
    }
    
        
    public function read(){
        $res = $this->clienteDAO->read();
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessun cliente trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );

    }
    
    public function readById($id){
        $res = $this->clienteDAO->readById($id);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessun cliente trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );

    }
    
    public function readParametriControllo($id, $anno, $mese, $id_livello, $desc_livello){
        $cliente = $this->readById($id)['res'][0];
        $ct = $cliente['ct'];
        $parametriControllo = $this->clienteDAO->readParametriControllo($ct, $anno, $mese, $id_livello, $desc_livello);
        if ($parametriControllo==null){
            return array(
                'status' => 'fail',
                'message' => 'nessun dato trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' =>  $parametriControllo,
            'status' => 'success'
        );
    }


    //DA MODIFICARE....
    public function readIncrementoByCluster($cf){
        $res = $this->waveSeriJakalaService->readCurrentWavesSeriJakala();
        
        $this->readDatiFatturazione($id, $anno, $datainizio, $datafine);
        if ($res==null){
            $incremento=-1;
        } else {
          
            $cluster = $res[0]['cluster'];
            if ($cluster==1){
                $incremento = 500;
            } else {
                $incremento = 350;
            }
        }
        return array(
            'res' =>  $incremento,
            'status' => 'success'
        );
        
    }

    public function readDatiFatturazione($id, $anno, $datainizio, $datafine){
        $cliente = $this->readById($id)['res'][0];
        
        $elencoCF = $this->clienteDAO->elencoCodiciCF($cliente['ct']);
        $datiFatturazione = $this->clienteDAO->readDatiFatturazione($cliente['ct'],$anno,  $datainizio, $datafine);
        
        if ($datiFatturazione==null){
            
            /*return array(
                'status' => 'fail',
                'message' => 'nessun dato di fatturazione trovato',
                'error' => 'NO_DATA'
            )*/;
            $datiFatturazione = array();
        } 
        return array(
            'res' => array( 'codiciCF' => $elencoCF, 'datiFatturazione' => $datiFatturazione),
            'status' => 'success'
        );

    }
    
    public function elencoClienti($id,$application,$itemsPerPage,$currentPage,$localita,$provincia){
        $clienti = $this->clienteDAO->elencoClienti($id,$application,$itemsPerPage,$currentPage,$localita,$provincia);
        if (count($clienti['clienti'])==0){
            return array(
                'status' => 'fail',
                'message' => 'nessun cliente trovato',
                'error' => 'NO_DATA'
            );
        } else {
            return array(
                'res' => $clienti,
                'status' => 'success'
            );
        }  
        
    }

    
    

}
