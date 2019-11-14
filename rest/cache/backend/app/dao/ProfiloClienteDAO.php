<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class ProfiloClienteDAO__AopProxied extends DAOAbstract implements DAOInterface {

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
    }

    public function update($item) {
         //NOP
    }

    public function readProfilo($id_cliente) {
        $sql = "SELECT * FROM survey_cliente_profilo where id_cliente = :id_cliente";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function readElencoProfili() {
        $sql = "SELECT * FROM survey_profilo";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function setProfiloCliente($id_cliente, $id_profilo) {
        /*
        $sql = "DELETE FROM survey_cliente_profilo where ID_CLIENTE = :id_cliente";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->execute();
        */
        //Come posso gestire il caso in cui l'id_cliente non esiste?
        $sql = "INSERT INTO survey_cliente_profilo VALUES (:id_cliente, :id_profilo)"
                . " ON DUPLICATE KEY UPDATE ID_PROFILO=:id_profilo";
        
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_cliente', $id_cliente);
        $stmt->bindParam('id_profilo', $id_profilo);
        $stmt->execute();
        return $id_profilo;
    }

    public function readByID($id) {
        //NOP
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\ProfiloClienteDAO.php';

