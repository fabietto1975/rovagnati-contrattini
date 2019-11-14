<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\ListinoService;


/**
 * @api {get} /rest/contrattino/:user_id (a) Elenco contrattini
 * @apiName Contrattino
 * @apiGroup GetContrattino
 * 
 *
 */


class ListinoController extends AbstractController {

    private $listinoService;

    public function __construct($request) {
        parent::__construct($request);
        $this->listinoService = new ListinoService();
    }

    public function getAction() {
        if (isset($this->request->url_elements [2])) {
            $id = $this->request->url_elements [2];
            $res = $this->listinoService->readById($id);
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $this->getResultData($res, 'listino', $res['message']);
            } else {
                $this->getResultData($res, 'listino', null);
            }
        } else {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTALLOWED;
        }    
        return $this->data;
    }

    public function postAction() {   
        $parameters = $this->request->parameters;
        $res = $this->contrattinoService->create($parameters);
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        } 
        $this->getResultData($res, 'contrattino', null);
        return $this->data;

        
    }

    public function deleteAction() { 
    }

    public function putAction() {
        $parameters = $this->request->parameters;
        $res = $this->contrattinoService->update($parameters);
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        } 
        $this->getResultData($res, 'contrattino', null);
        return $this->data;
    }

}
