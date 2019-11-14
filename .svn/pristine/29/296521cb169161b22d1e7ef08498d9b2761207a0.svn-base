<?php

namespace backend\app\service;

use backend\app\dao\UserDAO;

class UserService {

    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function read() {
        $res = $this->userDAO->read();
        return $res;
    }

    public function update($user) {
        $res = $this->userDAO->update($user);
        return array(
            'status' => 'success',
            'res' => $res
        );
    }

    public function login($username, $password, $application) {
        return $this->userDAO->login($username, $password, $application);
    }

    public function leggiGerarchia($id, $livello) {
        $res = $this->userDAO->leggiGerarchia($id, $livello);
        if ($res == null) {
            return array(
                'status' => 'fail',
                'message' => 'nessun utente trovato',
                'error' => 'NO_DATA'
            );
        }
        return array(
            'res' => $res['res'],
            'status' => 'success'
        );
    }

    public function readByID($id) {
        $res = $this->userDAO->readByID($id);
        if ($res == null) {
            return array(
                'status' => 'fail',
                'message' => 'nessun utente trovato',
                'error' => 'NO_DATA'
            );
        }
        return array(
            'res' => $res,
            'status' => 'success'
        );
    }

}
