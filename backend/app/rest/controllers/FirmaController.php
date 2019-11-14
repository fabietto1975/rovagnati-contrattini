<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\FirmaService;


class FirmaController extends AbstractController {

    private $firmaService;

    public function __construct($request) {
        parent::__construct($request);
        $this->firmaService = new FirmaService();
    }

    public function getAction() {}

    public function postAction() {
        $parameters = $this->request->parameters;
        $id_contrattino = $this->request->url_elements [2];
        $res = $this->firmaService->upload($id_contrattino,$parameters);
        $message = null;
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_INTERNAL_SERVER_ERROR;
            $message =  $res['message'];
        } 
        $this->getResultData($res, 'upload', $message);
        return $this->data;
    }

    public function deleteAction() { 
    }

    public function putAction() {
    }

}
