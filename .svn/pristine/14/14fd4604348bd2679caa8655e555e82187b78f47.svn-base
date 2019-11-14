<?php

namespace backend\app\service;

use backend\app\dao\ConcorrenteDAO;

class ConcorrenteService {

    private $concorrenteDAO;

    public function __construct() {
        $this->concorrenteDAO = new ConcorrenteDAO();
    }
    
        
    public function read(){
        $res = $this->concorrenteDAO->read();
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessun concorrente trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );

    }
    

    
    

}
