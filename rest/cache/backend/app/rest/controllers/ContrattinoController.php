<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\ContrattinoService;


/**
 * @api {get} /rest/contrattino/:user_id (a) Elenco contrattini
 * @apiName Contrattino
 * @apiGroup GetContrattino
 * 
 *
 */


class ContrattinoController__AopProxied extends AbstractController {

    private $contrattinoService;

    public function __construct($request) {
        parent::__construct($request);
        $this->contrattinoService = new ContrattinoService();
    }

    public function getAction() {
        if (isset($this->request->url_elements [2])) {
            $id = $this->request->url_elements [2];
            if ($id=='datacorrente'){
                $res =  array(
                    'res' => date('Y-m-d'),
                    'status' => 'success'
                );
                $this->getResultData($res, 'datacorrente', null);
            } else if ($id=='scontoobbiettivotargetspeciali'){
                $tipoobbiettivo =  $this->request->url_elements [3];
                $idprodotto     =  $this->request->url_elements [4];
                $obbiettivo     =  $this->request->parameters['obbiettivo'];
                $premio         =  $this->request->parameters['premio'];  
                $unitamisuraobbiettivo  =  (isset($this->request->parameters['unitamisuraobbiettivo'])?$this->request->parameters['unitamisuraobbiettivo']:null);  
                $sconto = $this->contrattinoService->calcolaSconto($tipoobbiettivo,$idprodotto,$obbiettivo,$premio,$unitamisuraobbiettivo);
                $res =  array(
                    'res' => $sconto,
                    'status' => 'success'
                );
                $this->getResultData($res, 'sconto', null);
            } else if ($id =='waveserijakala'){
                $res = $this->contrattinoService->readCurrentWavesSeriJakala();
                $message = null;
                if (isset($res['error'])) {
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    $message = $res['message'];
                }
                $this->getResultData($res, 'wave', $message);
                
            } else {    
                $res = $this->contrattinoService->readById($id);
                if (isset($res['error'])) {
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    $this->getResultData($res, 'contrattino', $res['message']);
                } else {
                    $this->getResultData($res, 'contrattino', null);
                }
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
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\ContrattinoController.php';

