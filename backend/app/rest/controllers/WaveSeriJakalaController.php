<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\WaveSeriJakalaService;



class WaveSeriJakalaController extends AbstractController {

    private $waveSeriJakalaService;

    public function __construct($request) {
        parent::__construct($request);
        $this->waveSeriJakalaService = new WaveSeriJakalaService();
    }

    public function getAction() {

        if (isset($this->request->url_elements [2])) {
            $action = $this->request->url_elements [2];
            if ($action == 'elencowavecorrenti') {
                $res = $this->waveSeriJakalaService->readCurrentWavesSeriJakala();
                $message = null;
                if (isset($res['error'])) {
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    $message = $res['message'];
                }
                $this->getResultData($res, 'wave', $message);
            } else if ($action == 'tipologia') {
                if (isset($this->request->url_elements [3])) {
                    $tipologia = $this->request->url_elements [3];
                    $res = $this->waveSeriJakalaService->readWavesSeriJakalaByTipologia($tipologia);
                    $message = null;
                    if (isset($res['error'])) {
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                        $message = $res['message'];
                    }
                    $this->getResultData($res, 'wave', $message);
                }
            } else {
                //by id
                if (isset($this->request->url_elements [3])) {
                    $action2 = isset($this->request->url_elements [3]);
                    if ($action2=='elencopremi'){
                        $res = $this->waveSeriJakalaService->readElencoPremi($action);
                        $message=null;
                        if (isset($res['error'])) {
                            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                            $message = $res['message'];
                        }
                        $this->getResultData($res, 'premiwave', $message);
                        
                    }
                }
            }
        } 
        return $this->data;
    }

    public function postAction() {
        
    }

    public function deleteAction() {
        
    }

    public function putAction() {
        
    }

}
