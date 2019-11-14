<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class RispostaDAO extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    } 


    /*public function  createRisposta($risposta){
        $sql = 'INSERT INTO survey_risposta(ID_DOMANDA, ID_CLIENTE, ID_RISPOSTA, VALORE_RISPOSTA, ID_UTENTE, ID_WAVE, DATA_CREAZIONE) VALUES (?,?,?,?,?,?, now())';
        $stmt = $this->getPdo()->prepare($sql);
        $id_domanda = $risposta['id_domanda'];
        $id_cliente = $risposta['id_cliente'];
        $id_utente = $risposta['id_utente'];
        $id_wave = $risposta['id_wave'];
        $id_risposta = (isset($risposta['id_risposta'])?$risposta['id_risposta']:"");
        $valore_risposta = $risposta['valore_risposta'];
        
        $stmt->bindValue(1, $id_domanda);
        $stmt->bindValue(2, $id_cliente);
        $stmt->bindValue(3, $id_risposta);
        $stmt->bindValue(4, $valore_risposta);
        $stmt->bindValue(5, $id_utente);
        $stmt->bindValue(6, $id_wave);
        $stmt->execute();
        $id = $this->getPdo()->lastInsertId();
        $res = $this->readByID($id);
        return $res;
    }
    
    public function updateRisposta($risposta){
        $sql = 'UPDATE survey_risposta '
                . ' SET VALORE_RISPOSTA= ?, ID_RISPOSTA= ?, DATA_AGGIORNAMENTO= now() WHERE ID =?';
        $stmt = $this->getPdo()->prepare($sql);
        $id = $risposta['id'];
        $valore_risposta = $risposta['valore_risposta'];
        $id_risposta = (isset($risposta['id_risposta'])?$risposta['id_risposta']:"");
        
        $stmt->bindValue(1, $valore_risposta);
        $stmt->bindValue(2, $id_risposta);
        $stmt->bindValue(3, $id);
        $stmt->execute();
        return $risposta;
    }*/
    
    //Probabilmente l'ho sviluppato più complicato del dovuto, ma non mi trovavo bene con l'operazione MySql "ON DUPLICATE KEY UPDATE"
    public function createUpdateRisposte($id_cliente, $id_utente, $risposte) {
        foreach ($risposte['risposte'] as $ris) {            
            if ($ris['id_risposta'] == null) {       //INSERT                     
                $sql = "INSERT INTO survey_risposta (id_domanda, id_cliente, id_risposta, valore_risposta, id_utente, id_wave, data_creazione)
                        VALUES (:id_domanda, :id_cliente, :id_valore_risposta, :valore_risposta, :id_utente, :id_wave, now())";

                $stmt = $this->getPdo()->prepare($sql);
                $stmt->bindParam('id_domanda', $ris['id_domanda']);
                $stmt->bindParam('id_cliente', $id_cliente);
                $stmt->bindParam('id_valore_risposta', $ris['id_valore_risposta']);
                $stmt->bindParam('valore_risposta', $ris['valore_risposta']);
                $stmt->bindParam('id_utente', $id_utente);
                $stmt->bindParam('id_wave', $ris['id_wave']);
            } else {                                 //UPDATE
                $sql = "UPDATE survey_risposta
                        SET id_risposta = :id_valore_risposta
                            , valore_risposta = :valore_risposta
                            , data_aggiornamento = now()
                        WHERE id = :id_risposta";

                $stmt = $this->getPdo()->prepare($sql);
                $stmt->bindParam('id_valore_risposta', $ris['id_valore_risposta']);
                $stmt->bindParam('valore_risposta', $ris['valore_risposta']);
                $stmt->bindParam('id_risposta', $ris['id_risposta']);
            } 

            $stmt->execute();
        }
        
        return;
    }

    public function delete($id) {
        //NOP
    }

    public function read() {}


    public function readByID($id) {
        $sql = 'SELECT * FROM  survey_risposta WHERE ID = :id_risposta';
        $stmt = $this->getPdo()->prepare($sql);

        $stmt->bindParam('id_risposta', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($item) {
        
    }

    public function update($item) {
        
    }

}
