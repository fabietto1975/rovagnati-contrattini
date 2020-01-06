<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\ClienteService;

/**
 * @api {get} /rest/contrattino/:user_id (a) Elenco contrattini
 * @apiName Contrattino
 * @apiGroup GetContrattino
 * 
 *
 */
class ClienteController extends AbstractController {

    private $clienteService;

    public function __construct($request) {
        parent::__construct($request);
        $this->clienteService = new ClienteService();
    }

    public function getAction() {
        if (isset($this->request->url_elements [2])) {
            $id = $this->request->url_elements [2];
            if ($id=='cluster'){
                if (isset($this->request->url_elements [3])){
                     $cf = $this->request->url_elements [3];
                     $res = $this->clienteService->readIncrementoByCluster($cf);
                     $this->getResultData($res, 'incremento', null);
                } else {
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTALLOWED;
                }
                return $this->data;
            } else  if (isset($this->request->url_elements [3])){
                $action = $this->request->url_elements [3];
                if ($action=='datifatturazione'){
                    $area = $this->request->parameters['area'];
                    if (isset($this->request->url_elements [4])){
                        $anno = $this->request->url_elements [4] ;
                        $res = $this->clienteService->readDatiFatturazione($id, $anno, null, null, $area);
                    } else {
                        $datainizio = $this->request->parameters['datainizio'];
                        $datafine = $this->request->parameters['datafine'];
                        $res = $this->clienteService->readDatiFatturazione($id, null, $datainizio, $datafine, $area);
                    }
                    
                } else if ($action=='parametridicontrollo'){
                    $anno = $this->request->url_elements [4];
                    $mese = $this->request->url_elements [5];
                    $livello = $this->request->url_elements [6];
                    $desc_livello =  $this->request->url_elements [7];
                    $res = $this->clienteService->readParametriControllo($id, $anno,$mese,$livello,$desc_livello);
                }else {
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTALLOWED;
                }
            } else {
                $res = $this->clienteService->readById($id);
            }
        } else {
            $res = $this->clienteService->read();
        }
        $message = null;
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
            $message = $res['message'];
        }
        $this->getResultData($res, 'profilocliente', $message);
        return $this->data;
    }

    public function postAction() {
        
    }

    public function deleteAction() {
        
    }

    public function putAction() {
        
    }

}
