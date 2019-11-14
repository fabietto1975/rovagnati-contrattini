<?php

namespace backend\app\service;

use backend\app\dao\ListinoDAO;

class ListinoService {

    private $listinoDAO;

    public function __construct() {
        $this->listinoDAO = new ListinoDAO();
    }
    
    public function readById($id){
        $res = $this->listinoDAO->readByID($id);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessuna riga lsitino trovata',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );

    }

}
