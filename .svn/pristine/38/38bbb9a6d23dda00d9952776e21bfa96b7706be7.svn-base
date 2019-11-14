<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\ImageService;


class ImageController extends AbstractController {

    private $imageService;

    public function __construct($request) {
        parent::__construct($request);
        $this->imageService = new ImageService();
    }

    public function getAction() {}

    public function postAction() {
        $parameters = $this->request->parameters;
        $id_cliente = $this->request->url_elements [2];
        $id_image = $this->request->url_elements [3];
        $area = $this->request->url_elements [4];
        $coordinate['latitudine'] = $this->request->parameters['latitudine'];
        $coordinate['longitudine'] = $this->request->parameters['longitudine'];
        $res = $this->imageService->upload($id_cliente, $id_image, $parameters, $area, $coordinate);
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
