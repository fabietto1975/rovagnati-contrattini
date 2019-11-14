<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class ConcorrenteDAO__AopProxied extends DAOAbstract implements DAOInterface {

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
        $stmt = $this->getPdo()->prepare("SELECT * FROM anagrafica_concorrente order by desc_concorrente");
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    public function update($item) {
         //NOP
    }

    public function readByID($id) {
        
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\ConcorrenteDAO.php';

