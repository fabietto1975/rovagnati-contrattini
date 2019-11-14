<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\FasceOrdineService;

class FasceOrdineController extends AbstractController {
    
    private $fasceOrdineService;

    public function __construct($request) {
        parent::__construct($request);
        $this->fasceOrdineService = new FasceOrdineService();
    }

    public function getAction() {
        $res = $this->fasceOrdineService->read();
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
            $this->getResultData($res, 'fasceordine', $res['message']);
        } else {
            $this->getResultData($res, 'fasceordine', null);
        }
        return $this->data;
    }

    public function postAction() {   }

    public function deleteAction() {
        
    }

    public function putAction() {}

}
