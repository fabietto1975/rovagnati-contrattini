<?php

namespace backend\app\service;

use backend\app\dao\ProdottoRovagnatiDAO;

class ProdottoRovagnatiService {

    private $prodottoRovagnatiDAO;

    public function __construct() {
        $this->prodottoRovagnatiDAO = new ProdottoRovagnatiDAO();
    }
    
    public function read(){
        $res = $this->prodottoRovagnatiDAO->read();
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'prodotti rovagnati non trovati',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }
    
    public function readProdottoRovagnatiPerLivello($id_livello, $filtro){
        $res = $this->prodottoRovagnatiDAO->readProdottoRovagnatiPerLivello($id_livello,$filtro);
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

}
