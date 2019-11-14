<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\ConcorrenteService;

/**
 * @api {get} /rest/concorrente (a) Elenco concorrenti
 * @apiName Concorrente
 * @apiGroup GetConcorrente
 * 
 *
 * @apiSuccess {String='success','fail'}                status                      Esito della richiesta .
 * @apiSuccess {String}                                 code                        Status code HTTP
 * @apiSuccess {String}                                 request_time                Timestamp relativo alla ricezione della richiesta.
 * @apiSuccess {String}                                 response_time               Timestamp relativo alla generazione della risposta.
 * @apiSuccess {Object}                                 rilevazione                 Dati rilevazione
 * @apiSuccess {String}                                 id                          Id rilevazione
 * @apiSuccess {String}                                 data_inizio                 Data inizio validita' rilevazione (YYYY-mm-dd)
 * @apiSuccess {String}                                 data_fine                   Data termine validita' rilevazione (YYYY-mm-dd)
 * @apiSuccess {String}                                 id_famiglia                 Id famiglia prodotto (cat. merceologica) oggetto della rilevazione
 * @apiSuccess {String}                                 descrizione_famiglia        Desc famiglia prodotto (cat. merceologica) oggetto della rilevazione
 * 
 * @apiSuccessExample Success-Response:
 * 
 * {
 *   "request_time": "Mon May 30 19:13:55 CEST 2016",
 *   "code": 200,
 *   "response_time": "Mon May 30 19:13:55 CEST 2016",
 *   "status": "success",
 *   "concorrente": [
 *      {
 *          "id": "4",
 *          "desc_concorrente": "CONCORRENTE1"
 *      },
 *      {
 *          "id": "14",
 *          "desc_concorrente": "CONCORRENTE21"
 *      }]
 */


class ConcorrenteController__AopProxied extends AbstractController {

    private $concorrenteService;

    public function __construct($request) {
        parent::__construct($request);
        $this->concorrenteService = new ConcorrenteService();
    }

    public function getAction() {
        $res = $this->concorrenteService->read();
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
            $this->getResultData($res, 'concorrente', $res['message']);
        } else {
            $this->getResultData($res, 'concorrente', null);
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
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\ConcorrenteController.php';

