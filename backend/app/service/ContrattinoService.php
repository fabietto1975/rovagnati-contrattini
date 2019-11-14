<?php

namespace backend\app\service;

use backend\app\dao\ContrattinoDAO;
use backend\app\dao\ListinoDAO;
use backend\app\dao\WaveSeriJakalaDAO;

class ContrattinoService {

    private $contrattinoDAO;
    private $listinoDAO;
    private $waveSeriJakalaDAO;
    
    public function __construct() {
        $this->contrattinoDAO = new ContrattinoDAO();
        $this->listinoDAO = new ListinoDAO();
        $this->waveSeriJakalaDAO = new WaveSeriJakalaDAO();
    }
    
        
    public function readByUser($id_user,$filtro){
        $res = $this->contrattinoDAO->readByUser($id_user,$filtro);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessun contrattino trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );

    }
    
    public function readById($id){
        $res = $this->contrattinoDAO->readByID($id);
        if ($res==null){
            return array(
                'status' => 'fail',
                'message' => 'nessun contrattino trovato',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'res' => $res,
            'status' => 'success'
        );

    }
    
    public function create($contrattino){
        $res = $this->contrattinoDAO->create($contrattino);
        if ($res==null){
            return array(
                'status' => 'error',
                'message' => 'impossible creare contratto',
                'error' => 'NO_DATA'
            );
        } 
        return array(
            'status' => 'success',
            'res' => $res
        );
    }

    public function update($contrattino){
        $res = $this->contrattinoDAO->update($contrattino);
        return array(
            'status' => 'success',
            'res' => $res
        );
    }

    
    public function calcolaSconto($tipoobbiettivo,$idprodotto,$obbiettivo,$premio, $unitamisuraobbiettivo){
        $listino = $this->listinoDAO->readByID($idprodotto)[0];
        if($tipoobbiettivo==1){
            /* eur/kg */
            return floatval($premio);
        } else if($tipoobbiettivo==2){
            /* importofisso */
            if ($unitamisuraobbiettivo==1){
                /* pezzi*/
                $fatturato = $obbiettivo*$listino['pesomedio']*$listino['prezzolistino'];
            } else if ($unitamisuraobbiettivo==2){
                /* cartoni */
                $fatturato = $obbiettivo*$listino['pesomedio']*$listino['pezzicartone']*$listino['prezzolistino'];
            } else if ($unitamisuraobbiettivo==3){
                /* fatturato */
                $fatturato = $obbiettivo;
            } else if ($unitamisuraobbiettivo==4){
                /* kg */
                $fatturato = $obbiettivo * $listino['prezzolistino'];
            }
            return $listino['prezzolistino']*(1-(($fatturato-$premio)/$fatturato));
        } else if($tipoobbiettivo==3){
            /* eur/pezzo */
            return ($listino['prezzolistino']- (($listino['prezzolistino']*$listino['pesomedio'])-$premio)/$listino['pesomedio'] );
        } else if($tipoobbiettivo==4){
            /* eur/cartone */
            return $listino['prezzolistino']-( (($listino['prezzolistino'] * $listino['pezzicartone'] *  $listino['pesomedio'])-$premio) / ($listino['pesomedio'] * $listino['pezzicartone'] ));
        } else if($tipoobbiettivo==5){
            /* % sconto */
            return ($premio/100)*$listino['prezzolistino'];
        } 
        
    }    
    
    
}
