<?php

namespace backend\app\service;

use backend\app\dao\RispostaDAO;

class RispostaService {

    private $rispostaDAO;
    private $surveyService;

    public function __construct() {
        $this->rispostaDAO = new RispostaDAO();
        $this->surveyService = new SurveyService();
    }

    public function read() {
        
    }
    
    public function createUpdate($id_cliente, $id_utente, $id_wave, $id_profilo, $item) {
        $res = $this->rispostaDAO->createUpdateRisposte($id_cliente, $id_utente, $item);

        return $this->surveyService->readDomandeRisposteCliente ($id_cliente, $id_profilo, $id_wave);
        
    }


    /*public function update($item) {
        $res = $this->rispostaDAO->updateRisposta($item);
        return array(
            'status' => 'success',
            'res' => $res
        );
        
    }

    public function create($item) {
        $res = $this->rispostaDAO->createRisposta($item);
        return array(
            'status' => 'success',
            'res' => $res
        );
        
    }*/

}
