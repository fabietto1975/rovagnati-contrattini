<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;
use PDO;
class WaveSeriJakalaDAO__AopProxied extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    }

    
    public function readByID($id) {
        $sql = "SELECT * FROM anagrafica_wave_serijakala WHERE id=:id";
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

    public function readCurrentWaves(){
        $sql = "SELECT id, descrizione, tipologia_wave, datainizio, datafine, claim,body FROM anagrafica_wave_serijakala WHERE WAVE_CORRENTE='1'";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

    
    public function readElencoPremi($id_wave,$tipologia_wave) {
        $sql='';
        if ($tipologia_wave=='PUNTI' || $tipologia_wave=='GIRO'){
            $sql = 'SELECT 
                        punti_kg, p.id as ID_PREMIO, descrizione, produttore, id_livello_punti
                    FROM
                        anagrafica_premi_serijakala p
                            LEFT JOIN
                        anagrafica_livelli_punti lp ON lp.id = p.id_livello_punti
                    where lp.ID_WAVE = :id_wave    
                    ORDER BY ordine , produttore';
        } else if ($tipologia_wave=='INCREMENTOFATTURATO'){
            $sql = 'SELECT 
                        label,p.id as ID_PREMIO, descrizione, produttore, id_fascia
                    FROM
                            anagrafica_premi_serijakala p
                            LEFT JOIN
                        anagrafica_fasce_incremento f ON f.id = p.id_fascia
                    WHERE f.ID_WAVE = :id_wave   
                    ORDER BY ordine , produttore;';
        }
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('id_wave', $id_wave);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC| PDO::FETCH_GROUP);
        return $res;
    }

    public function readWavesSeriJakalaByTipologia($tipologia) {
        $sql = "SELECT id, descrizione, tipologia_wave, datainizio, datafine, claim FROM anagrafica_wave_serijakala WHERE tipologia_wave=:tipologia LIMIT 1";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam('tipologia', $tipologia);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return $res;
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\WaveSerijakalaDAO.php';

