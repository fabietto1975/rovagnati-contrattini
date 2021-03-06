<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\FamigliaProdottoService;

/**
 * @api {get} /rest/rilevazione/famigliaprodotto (a) Richiesta dati relativi alle famiglie prodotto
 * @apiName GetFamiglieProdotto
 * @apiGroup FamiglieProdotto
 * 
 *
 * @apiSuccess {String='success','fail'}                status                      Esito della richiesta .
 * @apiSuccess {String}                                 code                        Status code HTTP
 * @apiSuccess {String}                                 request_time                Timestamp relativo alla ricezione della richiesta.
 * @apiSuccess {String}                                 response_time               Timestamp relativo alla generazione della risposta.
 * @apiSuccess {Object[]}                                famigliaprodotto           Dati famiglia prodotto
 * @apiSuccess {String}                                 id                          Id famiglia
 * @apiSuccess {String}                                 desc_famiglia               Desc famiglia prodotto 
 * 
 * @apiSuccessExample Success-Response:
 * 
 * {
 *   "request_time": "Mon May 30 19:13:55 CEST 2016",
 *   "code": 200,
 *   "response_time": "Mon May 30 19:13:55 CEST 2016",
 *   "status": "success",
 *   "famigliaprodotto": [
 *        {
 *            "id": "8",
 *            "desc_famiglia": "COTTO"
 *        },
 *        {
 *            "id": "9",
 *            "desc_famiglia": "CRUDI"
 *        },
 *        {
 *            "id": "10",
 *            "desc_famiglia": "MORTADELLA"
 *        },
 *        {
 *            "id": "11",
 *            "desc_famiglia": "SALAME"
 *        },
 *        {
 *            "id": "12",
 *            "desc_famiglia": "PANCETTA"
 *        },
 *        {
 *            "id": "13",
 *            "desc_famiglia": "ALTRI PRODOTTI SUINI"
 *        },
 *        {
 *            "id": "14",
 *            "desc_famiglia": "ALTRI PRODOTTI NON SUINI"
 *        }
 *    ]
 * }
 */
/**
 * @api {get} /rest/rilevazione/famigliaprodotto/:id_famiglia (b) Richiesta dati relativi al dettaglio famiglia prodotto
 * @apiName GetFamigliaProdotto
 * @apiGroup FamiglieProdotto
 * 
 * @apiParam {String} id_famiglia                       Id famiglia prodotto
 *
 * @apiSuccess {String='success','fail'}                status                      Esito della richiesta .
 * @apiSuccess {String}                                 code                        Status code HTTP
 * @apiSuccess {String}                                 request_time                Timestamp relativo alla ricezione della richiesta.
 * @apiSuccess {String}                                 response_time               Timestamp relativo alla generazione della risposta.
 * @apiSuccess {Object}                                 famigliaprodotto            Dati famigliaprodotto
 * @apiSuccess {String}                                 id                          Id famiglia
 * @apiSuccess {String}                                 desc_famiglia               Desc famiglia prodotto 
 * 
 * @apiSuccessExample Success-Response:
 * 
 * {
 *   "request_time": "Mon May 30 19:13:55 CEST 2016",
 *   "code": 200,
 *   "response_time": "Mon May 30 19:13:55 CEST 2016",
 *   "status": "success",
 *   "famigliaprodotto": [
 *        {
 *            "id": "8",
 *            "desc_famiglia": "COTTO"
 *        }
 *    ]
 * }
 */

/**
 * @api {get} /rest/rilevazione/famigliaprodotto/:id_famiglia/tipoprodotto (c) Richiesta dati relativi ai tipi prodotto collegati alla data famiglia prodotto
 * @apiName GetTipiProdotto
 * @apiGroup FamiglieProdotto
 * 
 * @apiParam {String} id_famiglia                       Id famiglia prodotto
 *
 * @apiSuccess {String='success','fail'}                status                      Esito della richiesta .
 * @apiSuccess {String}                                 code                        Status code HTTP
 * @apiSuccess {String}                                 request_time                Timestamp relativo alla ricezione della richiesta.
 * @apiSuccess {String}                                 response_time               Timestamp relativo alla generazione della risposta.
 * @apiSuccess {Object[]}                               tipoprodotto                Dati tipo prodotto
 * @apiSuccess {String}                                 id_tipo_prodotto            Id id_tipo_prodotto
 * @apiSuccess {String}                                 desc_tipo_prodotto          Desc tipo prodotto
 * 
 * @apiSuccessExample Success-Response:
 * 
 * {
 *   "request_time": "Mon May 30 19:13:55 CEST 2016",
 *   "code": 200,
 *   "response_time": "Mon May 30 19:13:55 CEST 2016",
 *   "status": "success",
 *    "tipoprodotto": [
 *        {
 *            "id_tipo_prodotto": "327",
 *            "desc_tipo_prodotto": "AROMATIZZATO O ARROSTO-BRACE"
 *        },
 *        {
 *            "id_tipo_prodotto": "340",
 *            "desc_tipo_prodotto": "LISCIO"
 *        }
 *    ]
 * }
 */
class FamigliaProdottoController__AopProxied extends AbstractController {

    private $famigliaProdottoService;

    public function __construct($request) {
        parent::__construct($request);
        $this->famigliaProdottoService = new FamigliaProdottoService();
    }

    public function getAction() {

        if (isset($this->request->url_elements [2])) {
            $id_famiglia = $this->request->url_elements [2];
            if (isset($this->request->url_elements [3])) {
                $action = $this->request->url_elements [3];
                if ($action == 'tipoprodotto') {
                    $res = $this->famigliaProdottoService->readTipiProdotto($id_famiglia);
                    if (isset($res['error'])) {
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                        $this->getResultData($res, 'tipoprodotto', $res['message']);
                    } else {
                        $this->getResultData($res, 'tipoprodotto', null);
                    }
                }
                if ($action == 'tipoprodottorovagnati') {
                    
                    if (isset($this->request->url_elements [4])){
                        $action_2 = $this->request->url_elements [4];
                        if($action_2=='filtropertipo'){
                            $id_tipo_prodotto = $this->request->url_elements [5];
                            $res = $this->famigliaProdottoService->readTipiProdottoRovagnatiTipoProdotto($id_famiglia,$id_tipo_prodotto);
                        }    
                        
                    } else {
                        $res = $this->famigliaProdottoService->readTipiProdottoRovagnati($id_famiglia);
                        
                    }
                    $message = null;
                    if (isset($res['error'])) {
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    } 
                    $this->getResultData($res, 'tipoprodotto', $message);
                }
            } else {
                $res = $this->famigliaProdottoService->readById($id_famiglia);
                if (isset($res['error'])) {
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    $this->getResultData($res, 'famigliaprodotto', $res['message']);
                } else {
                    $this->getResultData($res, 'famigliaprodotto', null);
                }
            }
        } else {
            $res = $this->famigliaProdottoService->read();
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $this->getResultData($res, 'famigliaprodotto', $res['message']);
            } else {
                $this->getResultData($res, 'famigliaprodotto', null);
            }
            $this->getResultData($res, 'famigliaprodotto', null);
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
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\FamigliaProdottoController.php';

