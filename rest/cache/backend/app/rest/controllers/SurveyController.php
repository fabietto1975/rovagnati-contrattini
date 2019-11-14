<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\SurveyService;

class SurveyController__AopProxied extends AbstractController {
    
    private $surveyService;

    public function __construct($request) {
        parent::__construct($request);
        $this->surveyService = new SurveyService();
    }

    public function getAction() {
        if (isset($this->request->url_elements [2])) {
            $action = $this->request->url_elements [2];
            
            switch($action) {
                case 'wavecorrente':
                    $res = $this->surveyService->readWaveCorrente();

                    break;
                case 'domanda':
                    if (isset($this->request->url_elements [3]) && isset($this->request->url_elements [4]) && isset($this->request->url_elements [5])) {
                        $id_cliente = $this->request->url_elements [3]; 
                        $id_profilo = $this->request->url_elements [4];             
                        $id_wave = $this->request->url_elements [5]; 
                        $res = $this->surveyService->readDomandeRisposteCliente($id_cliente, $id_profilo, $id_wave);
                    }
                    
                    break;
                default:
                    break;
            }
            
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $this->getResultData($res, 'survey', $res['message']);
            } else {
                $this->getResultData($res, 'survey', null);
            }
        } else {
            //NOP for now            
        }
        return $this->data;
    }

    public function postAction() {
        if (isset($this->request->url_elements [2])) {
            $action = $this->request->url_elements [2];
            
            switch($action) {
                case 'risposta':
                    $parameters = $this->request->parameters;
                    $res = $this->surveyService->createRisposta($parameters);
                    
                    break;
                default:                    
                    break;
            }
            
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $this->getResultData($res, 'survey', $res['message']);
            } else {
                $this->getResultData($res, 'survey', null);
            }
        }    
        
        return $this->data;
    }

    public function deleteAction() {
        
    }

    public function putAction() {
        if (isset($this->request->url_elements [2])) {
            $action = $this->request->url_elements [2];
            
            switch($action) {
                case 'risposta':
                    $parameters = $this->request->parameters;
                    $res = $this->surveyService->updateRisposta($parameters);
                    
                    break;
                default:                    
                    break;
            }
            
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $this->getResultData($res, 'survey', $res['message']);
            } else {
                $this->getResultData($res, 'survey', null);
            }
        }    
        
        return $this->data;        
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\SurveyController.php';

