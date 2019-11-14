<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class FasceOrdineDAO extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    } 

    public function create($item) {
        //NOP
    }

    public function update($item) {
        //NOP
    }

    public function readById($id) {
    }

    public function delete($id) {
        //NOP
    }



    public function read() {
        $stmt = $this->getPdo()->prepare("select id, label, valore from anagrafica_fasce_ordine where id>0 order by ordine;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
