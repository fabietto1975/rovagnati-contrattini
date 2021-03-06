<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class ConcorrenteDAO extends DAOAbstract implements DAOInterface {

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
        $stmt = $this->getPdo()->prepare("SELECT * FROM anagrafica_concorrente order by ordine");
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    public function update($item) {
         //NOP
    }

    public function readByID($id) {
        
    }

}
