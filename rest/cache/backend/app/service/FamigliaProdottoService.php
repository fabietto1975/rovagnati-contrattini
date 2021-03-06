<?php

namespace backend\app\service;

use backend\app\dao\FamigliaProdottoDAO;

class FamigliaProdottoService {

    private $famigliaProdottoDAO;

    public function __construct() {
        $this->famigliaProdottoDAO = new FamigliaProdottoDAO();
    }
    
    public function read(){
        $res = $this->famigliaProdottoDAO->read();
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessuna famiglia prodotto attiva',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }
    
    public function readById($id_famiglia){
        $res = $this->famigliaProdottoDAO->readById($id_famiglia);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'famiglia prodotto non trovata',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }


    public function readTipiProdotto($id_famiglia){
        $res = $this->famigliaProdottoDAO->readTipiProdotto($id_famiglia);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'tipo prodotto non trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }

    public function readTipiProdottoRovagnati($id_famiglia){
        $res = $this->famigliaProdottoDAO->readTipiProdottoRovagnati($id_famiglia);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'tipo prodotto rovagnati non trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }

    public function readTipiProdottoRovagnatiTipoProdotto($id_famiglia,$id_tipo_prodotto){
        $res = $this->famigliaProdottoDAO->readTipiProdottoRovagnatiTipoProdotto($id_famiglia,$id_tipo_prodotto);

        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'tipo prodotto rovagnati non trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );
        
    }
    

}
