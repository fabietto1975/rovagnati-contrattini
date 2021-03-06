<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\RilevazioneService;

/**
 * @api {get} /rest/rilevazione/rilevazionecorrente (a) Richiesta dati relativi alla rilevazione concorrenza attualmente attiva
 * @apiName Rilevazione
 * @apiGroup Rilevazione
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
 *   "rilevazione": {
 *       "id": "4",
 *       "data_inizio": "2015-04-01 00:00:00",
 *       "data_fine": "2016-12-31 00:00:00",
 *       "id_famiglia": "12",
 *       "descrizione_famiglia": "PANCETTA"
 *   }
 */

/**
 * @api {get} /rest/rilevazione/:id_cliente/:id_rilevazione (b) Richiesta dati relativi scheda di rilevazione concorrenza
 * @apiName SchedaRilevazione
 * @apiGroup Rilevazione
 * 
 * @apiParam {String} id_cliente                        Identificativo cliente oggetto della rilevazione (come da risposta di /rest/users/login)
 * @apiParam {String} id_rilevazione                    Identificativo rilevazione (come da risposta di /rest/rilevazione/rilevazionecorrente)
 *
 * @apiSuccess {String='success','fail'}                status                      Esito della richiesta .
 * @apiSuccess {String}                                 code                        Status code HTTP
 * @apiSuccess {String}                                 request_time                Timestamp relativo alla ricezione della richiesta.
 * @apiSuccess {String}                                 response_time               Timestamp relativo alla generazione della risposta.
 * @apiSuccess {Object[]}                               rilevazione                 Dati scheda di rilevazione prodotti
 * @apiSuccess {String}                                 id_rilevazione              Id rilevazione
 * @apiSuccess {String}                                 id_scheda_rilevazione       Id scheda di rilevazione
 * @apiSuccess {String}                                 id_cliente                  Id cliente
 * @apiSuccess {String}                                 id_utente                   Id utente (come da risposta /rest/users/login)
 * @apiSuccess {String}                                 username                    Username (come da risposta /rest/users/login)
 * @apiSuccess {String}                                 data_inizio_validita        Data iinzio validita' rilevazione
 * @apiSuccess {String}                                 data_fine_validita          Data iinzio fine rilevazione
 * @apiSuccess {String}                                 data_creazione_scheda       Categoria merceologica 
 * @apiSuccess {String}                                 data_ultimo_aggiornamento_scheda      Data ultimo aggiornamento scheda rilevazione
 * @apiSuccess {String}                                 id_dati_prodotto            Id record
 * @apiSuccess {String}                                 prezzo_prodotto             Prezzo del prodotto
 * @apiSuccess {String}                                 ordine_prodotto             Ordine item
 * @apiSuccess {String}                                 prodotto_in_promozione      Flag (0/1) prodotto in promo
 * @apiSuccess {String}                                 prodotto_top_seller         Flag (0/1) prodotto top sell
 * 
 * 
 * @apiSuccessExample Success-Response:
 * 
 * {
 *   "request_time": "Tue May 31 10:09:34 CEST 2016",
 *   "code": 200,
 *   "response_time": "Tue May 31 10:09:34 CEST 2016",
 *   "status": "success",
 *   "rilevazione":    [
 *  {
 *        "id_rilevazione": "4",
 *        "id_scheda_rilevazione": "0",
 *        "id_cliente": "1",
 *        "id_utente": "1",
 *        "username": "user9002",
 *        "categoria_merceologica": "PANCETTA",
 *        "data_inizio_validita": "2015-04-01 00:00:00",
 *        "data_fine_validita": "2016-12-31 00:00:00",
 *        "data_creazione_scheda": "2016-05-30 00:00:00",
 *        "data_ultimo_aggiornamento_scheda": "2016-05-30 00:00:00",
 *        "id_dati_prodotto": "3",
 *        "prezzo_prodotto": "2121.00",
 *        "ordine_prodotto": "0",
 *        "prodotto_in_promozione": "1",
 *        "prodotto_top_seller": "1"
 *     },
 *            {
 *         "id_rilevazione": "4",
 *         "id_scheda_rilevazione": "0",
 *         "id_cliente": "1",
 *         "id_utente": "1",
 *         "username": "user9002",
 *         "categoria_merceologica": "PANCETTA",
 *         "data_inizio_validita": "2015-04-01 00:00:00",
 *         "data_fine_validita": "2016-12-31 00:00:00",
 *         "data_creazione_scheda": "2016-05-30 00:00:00",
 *         "data_ultimo_aggiornamento_scheda": "2016-05-30 00:00:00",
 *         "id_dati_prodotto": "1",
 *         "prezzo_prodotto": "233.00",
 *         "ordine_prodotto": "1",
 *         "prodotto_in_promozione": "1",
 *         "prodotto_top_seller": "0"
 *      }
 *   ]
 * } 
 * 
 * 
 */
/*
 * @api {post} /rest/rilevazione/:id_cliente/:id_rilevazione (b) Richiesta dati relativi scheda di rilevazione concorrenza
 * @apiName SchedaRilevazione
 * @apiGroup Rilevazione

 * *{
 *   "request_time": "Mon Jun 20 16:57:53 CEST 2016",
 *   "code": 200,
 *   "response_time": "Mon Jun 20 16:57:53 CEST 2016",
 *   "status": "success",
 *   "rilevazione":    [
 *            {
 *         "id_rilevazione": "4",
 *         "id_scheda_rilevazione": "1",
 *         "id_cliente": "1",
 *         "nomecliente": "ANGELINI ALESSANDRO",
 *         "id_utente": "1",
 *         "username": "user9002",
 *         "id_dati_prodotto": "2",
 *         "id_famiglia_prodotto": "12",
 *         "famiglia_prodotto": "PANCETTA",
 *         "data_inizio_validita": "2015-04-01 00:00:00",
 *         "data_fine_validita": "2016-12-31 00:00:00",
 *         "data_creazione_scheda": "2016-06-20 16:57:53",
 *         "data_ultimo_aggiornamento_scheda": "2016-06-20 16:57:53",
 *         "prezzo_prodotto": "2122.00",
 *         "ordine_prodotto": "0",
 *         "prodotto_in_promozione": "1",
 *         "prodotto_top_seller": "1",
 *         "id_tipo_prodotto": "328",
 *         "desc_tipo_prodotto": "ARROSTI POLLO",
 *         "id_tipo_prodotto_rovagnati": null,
 *         "desc_tipo_prodotto_rovagnati": null
 *      },
 *            {
 *         "id_rilevazione": "4",
 *         "id_scheda_rilevazione": "1",
 *         "id_cliente": "1",
 *         "nomecliente": "ANGELINI ALESSANDRO",
 *         "id_utente": "1",
 *         "username": "user9002",
 *         "id_dati_prodotto": "3",
 *         "id_famiglia_prodotto": "12",
 *         "famiglia_prodotto": "PANCETTA",
 *         "data_inizio_validita": "2015-04-01 00:00:00",
 *         "data_fine_validita": "2016-12-31 00:00:00",
 *         "data_creazione_scheda": "2016-06-20 16:57:53",
 *         "data_ultimo_aggiornamento_scheda": "2016-06-20 16:57:53",
 *         "prezzo_prodotto": "233.00",
 *         "ordine_prodotto": "1",
 *         "prodotto_in_promozione": "1",
 *         "prodotto_top_seller": "0",
 *         "id_tipo_prodotto": null,
 *         "desc_tipo_prodotto": null,
 *         "id_tipo_prodotto_rovagnati": "328",
 *         "desc_tipo_prodotto_rovagnati": "ARROSTI POLLO"
 *      }
 *   ]
 * }
 * */


class RilevazioneController__AopProxied extends AbstractController {

    private $rilevazioneService;

    public function __construct($request) {
        parent::__construct($request);
        $this->rilevazioneService = new RilevazioneService();
    }

    public function getAction() {

        if (isset($this->request->url_elements [2])) {
            $action = $this->request->url_elements [2];
            if ($action == 'rilevazionecorrente') {
                $res = $this->rilevazioneService->readRilevazioneInCorso();
                if (isset($res['error'])) {
                    if (($res['error'] == 'DATA_ERROR') || ($res['error'] == 'NO_DATA')) {
                        $this->data['code'] = AbstractController::HTTP_CODE_INTERNAL_SERVER_ERROR;
                    } else {
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    }
                    $this->getResultData($res, 'rilevazione', $res['message']);
                } else {
                    $this->getResultData($res, 'rilevazione', null);
                }
                return $this->data;
            } else {
                $id_punto_vendita = $action;
                if (isset($this->request->url_elements [3])) {
                    $id_rilevazione = $this->request->url_elements [3];
                    $res = $this->rilevazioneService->readRilevazione($id_rilevazione, $id_punto_vendita);
                    if (isset($res['error'])) {
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                        $this->getResultData($res, 'rilevazione', $res['message']);
                    } else {
                        $this->getResultData($res, 'rilevazione', null);
                    }
                    return $this->data;
                }
            }
        } else {
            $this->data['code'] = AbstractController::HTTP_CODE_BADREQUEST;
            return $this->data;
        }
    }

    private function writeAction($method='POST'){
        $parameters = $this->request->parameters;
        if (isset($this->request->url_elements [2])) {
            if (isset($this->request->url_elements [3])) {
                if (isset($this->request->url_elements [4])) {
                    $id_punto_vendita = $this->request->url_elements [2];
                    $id_rilevazione = $this->request->url_elements [3];
                    $action = $this->request->url_elements [4];
                    if ($action == 'prodotto'){
                        if ($method=='POST'){
                            $res = $this->rilevazioneService->createProdotto($parameters,$id_punto_vendita,$id_rilevazione);
                        } else {
                            $id_informazioni_prodotto = $this->request->url_elements [5];
                            $res = $this->rilevazioneService->updateProdotto($parameters,$id_informazioni_prodotto);
                            
                        }   
                        if (isset($res['error'])) {
                            $this->data['code'] = AbstractController::HTTP_CODE_INTERNAL_SERVER_ERROR;
                        } else {
                            $message = null;
                            if (isset($res['message'])) {
                                $message = $res['message'];
                            }
                            $this->getResultData($res, 'prodotto', $message);
                        }
                    }
                }
            }
                    
        } else {
            $res = $this->rilevazioneService->create($parameters);
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_INTERNAL_SERVER_ERROR;
                $this->getResultData($res, 'rilevazione', $res['message']);
            } else {
                $this->getResultData($res, 'rilevazione', null);
            }
        }
        return $this->data;
    }
    
    
    public function postAction() {
        return $this->writeAction();
    }

    public function deleteAction() {
        if (isset($this->request->url_elements [2])) {
            if (isset($this->request->url_elements [3])) {
                if (isset($this->request->url_elements [4])) {
                    $id_punto_vendita = $this->request->url_elements [2];
                    $id_rilevazione = $this->request->url_elements [3];
                    $action = $this->request->url_elements [4];
                    if ($action=='prodotto'){
                        $id_informazioni_prodotto= $this->request->url_elements [5];
                    }
                    $res = $this->rilevazioneService->deleteProdotto($id_informazioni_prodotto);
                    if (isset($res['error'])) {
                        $this->data['code'] = AbstractController::HTTP_CODE_INTERNAL_SERVER_ERROR;
                    } else {
                        $message = null;
                        if (isset($res['message'])) {
                            $message = $res['message'];
                        }
                        $this->getResultData($res, 'prodotto', $message);
                    }
                }
            }
        }    
        return $this->data;
        
    }

    public function putAction() {
        return $this->writeAction('PUT');
    }    

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\RilevazioneController.php';

