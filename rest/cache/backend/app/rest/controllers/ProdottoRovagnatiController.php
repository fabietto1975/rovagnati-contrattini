<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\ProdottoRovagnatiService;



class ProdottoRovagnatiController__AopProxied extends AbstractController {

    private $prodottoRovagnatiService;

    public function __construct($request) {
        parent::__construct($request);
        $this->prodottoRovagnatiService = new ProdottoRovagnatiService();
    }

    public function getAction() {

        if (isset($this->request->url_elements [2])) {
            $action = $this->request->url_elements [2];
            if ($action == 'livello') {
                $id_livello = $this->request->url_elements [3];
                $params =    $this->request->parameters;
                $filtro = null;
                if (isset($params['divisione'])){
                    $filtro = explode('|',$params['divisione']);
                }
                $res = $this->prodottoRovagnatiService->readProdottoRovagnatiPerLivello($id_livello, $filtro);
                $message = null;
                if (isset($res['error'])) {
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    $message = $res['message'];
                }
                $this->getResultData($res, 'prodottorovagnati', $message);
            } else {
                //by id
            }
        } else {
            $res = $this->prodottoRovagnatiService->read();
            $message = null;
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $message = $res['message'];
            }
            $this->getResultData($res, 'prodottorovagnati', $message);
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
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\ProdottoRovagnatiController.php';

