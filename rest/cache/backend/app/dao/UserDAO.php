<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class UserDAO__AopProxied extends DAOAbstract implements DAOInterface {

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
        $stmt = $this->getPdo()->prepare(
                "SELECT * "
                . "FROM anagrafica_utente u "
                . "WHERE u.id=:id ");
        $stmt->bindValue('id', $id);
        $stmt->execute();
        $res = $stmt->fetch();
        return $res;
    }

    public function read() {
        
    }

    public function update($user) {
        $id = $user['id'];
        $cellulare = $user['cellulare'];
        $stmt = $this->getPdo()->prepare(""
                . " UPDATE ANAGRAFICA_UTENTE "
                . " SET CELLULARE =  :cellulare "
                . " WHERE ID = :id");
        $stmt->bindValue('id', $id);
        $stmt->bindValue('cellulare', $cellulare);
        $stmt->execute();
        return $this->readByID($id);
    }

    public function login($username, $password, $application) {
        $stmt = $this->getPdo()->prepare(""
                . "SELECT * "
                . "FROM anagrafica_utente u "
                . "WHERE u.USERNAME = :username and md5(:password) = u.password "
        );
        $stmt->bindValue('username', $username);
        $stmt->bindValue('password', $password);
        $stmt->execute();
        $res = $stmt->fetch();

        if ($res != null) {
            $cod_dipendente = $res['cod_dipendente'];
            $ruolo = $res['ruolo'];
            $colonna = '';
            if ($ruolo == 'AGENTE') {
                $colonna = 'agente';
            } else if ($ruolo == 'ISPETTORE') {
                $colonna = 'cod_ispettore';
            } else if ($ruolo == 'CAPOAREA') {
                $colonna = 'cod_capo_area';
            }
                        
            $sql =   "SELECT 
                        localita,
                        provincia_nazione as provincia,
                        CONCAT(localita,
                                ' (',
                                provincia_nazione,
                                ')'
                                ) AS descrizione_localita
                    FROM
                        anagrafica_cliente c
                    WHERE
                        " . $colonna . " = :cod_dipendente";
            if ($application=="RILEVAZIONI"){
                $sql .= " AND c.tipo IN ('DM', 'CF') and c.nazione='IT' and  c.DESC_CAT_MERCEOLOGICA !='Z - NON USARE' ";
            } else if ($application=="CONTRATTINI"){
                $sql .= " AND c.nazione = 'IT' AND tipo !='DM' AND c.cod_cli = c.ct AND c.DESC_CAT_MERCEOLOGICA != 'Z - NON USARE'"; 
            }
            $sql .= "GROUP BY localita ,  provincia_nazione ";                  
            $stmt = $this->getPdo()->prepare($sql);
            
            
            $stmt->bindValue('cod_dipendente', $cod_dipendente);
            $stmt->execute();
            $comuni = $stmt->fetchAll();
            $res['comuni'] = $comuni;
            return array(
                'status' => 'OK',
                'res' => $res
            );
        } else {
            return array(
                'status' => 'KO',
                'error' => 'LOGIN_ERROR'
            );
        }
    }

    public function leggiGerarchia($id, $livello) {
        $currentUser = $this->readByID($id);
        $ruolo = $currentUser['ruolo'];
        $dipendenti = array();
        //Lettura referenti ad un livello
        $sql = "SELECT u.*,u2.cod_dipendente as cod_referente, u2.nome as nome_referente, u2.ruolo as ruolo_referente
                FROM
                    anagrafica_utente u join anagrafica_utente u2 on (u.id_referente = u2.id)
                WHERE
                    u.id_referente = :id_referente
                ORDER BY u.NOME;";
        //Lettura referenti a due livelli
        $sql_2 = "
                SELECT 
                    u.*,u2.cod_dipendente as cod_referente, u2.nome as nome_referente, u2.ruolo as ruolo_referente
                FROM
                    anagrafica_utente u join anagrafica_utente u2 on (u.id_referente = u2.id)
                WHERE
                    u.id_referente IN (SELECT 
                            id
                        FROM
                            anagrafica_utente u1
                        WHERE
                            u1.id_referente = :id_referente)
                ORDER BY U.NOME;";

        $doQuery = false;
        if ($ruolo == 'AGENTE') {
            //NOP
        } else if ($ruolo == 'ISPETTORE') {
            if ($livello == 'AGENTE') {
                $stmt = $this->getPdo()->prepare($sql);
                $doQuery = true;
            }
        } else if ($ruolo == 'CAPOAREA') {
            if ($livello == 'AGENTE') {
                $doQuery = true;
                $stmt = $this->getPdo()->prepare($sql_2);
            } else if ($livello == 'ISPETTORE') {
                $doQuery = true;
                $stmt = $this->getPdo()->prepare($sql);
            }
        }
        if ($doQuery) {
            $stmt->bindValue('id_referente', $id);
            $stmt->execute();
            $dipendenti = $stmt->fetchAll();
        }
        return array(
            'status' => 'OK',
            'res' => $dipendenti
        );
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\UserDAO.php';

