<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class FamigliaProdottoDAO__AopProxied extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    } 

    public function create($item) {
        //NOP
    }

    public function delete($id) {
        //NOP
    }

    public function readByID($id_famiglia) {
        $stmt = $this->getPdo()->prepare("SELECT * FROM anagrafica_famiglia_prodotto where id = :id_famiglia;");
        $stmt->bindParam('id_famiglia', $id_famiglia);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readTipiProdotto($id_famiglia) {
        $stmt = $this->getPdo()->prepare("SELECT 
                        pr.id as ID_TIPO_PRODOTTO, pr.DESC_TIPO_PRODOTTO, a.id as ID_AGGREGANTE, a.DESC_AGGREGANTE
                    FROM
                        anagrafica_famiglia_prodotto f
                            JOIN
                        anagrafica_aggregante a ON (f.id = a.id_famiglia)
                            JOIN
                        anagrafica_tipo_prodotto pr ON (pr.id_aggregante = a.id)
                    where f.id = :id_famiglia;    ");
        $stmt->bindParam('id_famiglia', $id_famiglia);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readTipiProdottoRovagnati($id_famiglia) {
        $stmt = $this->getPdo()->prepare("SELECT 
                        pr.id as ID_TIPO_PRODOTTO, pr.DESC_TIPO_PRODOTTO, a.id as ID_AGGREGANTE, a.DESC_AGGREGANTE
                    FROM
                        anagrafica_famiglia_prodotto f
                            JOIN
                        anagrafica_aggregante a ON (f.id = a.id_famiglia)
                            JOIN
                        anagrafica_tipo_rovagnati pr ON (pr.id_aggregante = a.id)
                    where f.id = :id_famiglia;    ");
        $stmt->bindParam('id_famiglia', $id_famiglia);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function readTipiProdottoRovagnatiTipoProdotto($id_famiglia,$id_tipo_prodotto) {
        $stmt = $this->getPdo()->prepare("
                    SELECT 
                        pr.id as ID_TIPO_PRODOTTO, pr.DESC_TIPO_PRODOTTO, a.id as ID_AGGREGANTE, a.DESC_AGGREGANTE
                    FROM
                        anagrafica_famiglia_prodotto f
                            JOIN
                        anagrafica_aggregante a ON (f.id = a.id_famiglia)
                            JOIN
                        anagrafica_tipo_rovagnati pr ON (pr.id_aggregante = a.id)
                    where f.id = :id_famiglia and a.id = (select id_aggregante from anagrafica_tipo_prodotto where id = :id_tipo_prodotto);    ");
        $stmt->bindParam('id_famiglia', $id_famiglia);
        $stmt->bindParam('id_tipo_prodotto', $id_tipo_prodotto);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    

    public function read() {
        $stmt = $this->getPdo()->prepare("SELECT * FROM anagrafica_famiglia_prodotto;");
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    public function update($item) {
         //NOP
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\FamigliaProdottoDAO.php';

