<?php

namespace backend\app\service;

use backend\app\dao\ProfiloClienteDAO;

class ProfiloClienteService {

    private $profiloClienteDAO;

    public function __construct() {
        $this->profiloClienteDAO = new ProfiloClienteDAO();
    }
    
    public function read(){}
    
    public function readProfilo($id_cliente){
        $res = $this->profiloClienteDAO->readProfilo($id_cliente);
        
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'profilo cliente non trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }
    
    public function readElencoProfili(){
        $res = $this->profiloClienteDAO->readElencoProfili();
        
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'elenco profili cliente non trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }
    
    public function setProfiloCliente($id_cliente, $id_profilo) {
        $res = $this->profiloClienteDAO->setProfiloCliente($id_cliente, $id_profilo);
        
        return array(
            'status' => 'success',
            'res' => $res
        );
        
    }

}
