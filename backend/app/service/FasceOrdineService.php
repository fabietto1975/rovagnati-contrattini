<?php

namespace backend\app\service;

use backend\app\dao\FasceOrdineDAO;

class FasceOrdineService {

    private $fasceOrdineDAO;

    public function __construct() {
        $this->fasceOrdineDAO = new FasceOrdineDAO();
    }
    
    public function read(){
        $res = $this->fasceOrdineDAO->read();
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'fasce ordine non trovate',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }
    

}
