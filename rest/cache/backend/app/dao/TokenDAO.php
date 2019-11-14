<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class TokenDAO__AopProxied extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    } 

    public function create($item) {
        //NOP
    }

    public function delete($id) {
        //NOP
    }

    public function readByID($id) {
        //NOP
    }

    public function read() {
        
    }

    public function update($item) {
        //NOP
    }

    public function check($username, $password) {
        $stmt = $this->getPdo()->prepare(""
                . "SELECT * "
                . "FROM auth_utente_applicazione u "
                . "WHERE u.username = :username and md5(:password) = u.password "
                
        );
        $stmt->bindValue('username',    $username );
        $stmt->bindValue('password',    $password);
        $stmt->execute();
        $res = $stmt->fetch();
        if ($res!=null){
            return 'OK';
        } else {
            return 'KO';
        }
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\TokenDAO.php';

