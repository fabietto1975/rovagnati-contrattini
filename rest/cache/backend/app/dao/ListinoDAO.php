<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class ListinoDAO__AopProxied extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    }

    
    public function readByID($id) {
        $sql = "SELECT * FROM anagrafica_listino_rovagnati WHERE codice_articolo=:id and tipolistino='DET'";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

    public function create($item) {
        
    }

    public function delete($id) {
        
    }

    public function read() {
        
    }

    public function update($item) {
        
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\ListinoDAO.php';

