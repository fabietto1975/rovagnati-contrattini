<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\RispostaService;

class RispostaController__AopProxied extends AbstractController {

    private $rispostaService;

    public function __construct($request) {
        parent::__construct($request);
        $this->rispostaService = new RispostaService();
    }

    public function getAction() {
        
    }

    public function postAction() {
        /*$parameters = $this->request->parameters;
        $res = $this->rispostaService->create($parameters);
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        } 
        $this->getResultData($res, 'risposta', null);
        return $this->data;*/
        
        if (isset($this->request->url_elements [2]) && isset($this->request->url_elements [3])) {
            $id_cliente = $this->request->url_elements [2];
            $id_utente = $this->request->url_elements [3];            
            $id_wave = $this->request->url_elements [4];   
            $id_profilo = $this->request->url_elements [5];   
            $parameters = $this->request->parameters;
            $res = $this->rispostaService->createUpdate($id_cliente, $id_utente, $id_wave, $id_profilo, $parameters);
        }
        
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        } 
        $this->getResultData($res, 'risposta', null);
        return $this->data;
    }

    public function deleteAction() {
        
    }

    public function putAction() {
        /*$parameters = $this->request->parameters;
        $res = $this->rispostaService->update($parameters);
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        } 
        $this->getResultData($res, 'risposta', null);
        return $this->data;*/
        
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\RispostaController.php';

