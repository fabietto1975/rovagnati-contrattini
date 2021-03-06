<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\UserService;
use backend\app\service\ContrattinoService;
use backend\app\service\ClienteService;

/**
 * @api {post} /rest/users/login (a) Login Utente
 * @apiName LoginUtente
 * @apiGroup Utente
 * 
 * @apiParam {String} username Username
 * @apiParam {String} password Password
 * 
 * @apiParamExample {json} Request-Example:
 *  {
 *      "username":"USERNAME",
 *      "password":"PASSWORD"	
 *  }
 *
 * @apiSuccess {String='success','fail'}                status                      Esito della richiesta .
 * @apiSuccess {String}                                 request_time                Timestamp relativo alla ricezione della richiesta.
 * @apiSuccess {String}                                 response_time               Timestamp relativo alla generazione della risposta.
 * @apiSuccess {Object}                                 utente                      Profilo utente
 * @apiSuccess {String}                                 utente.id                   Id dell'utente 
 * @apiSuccess {String}                                 utente.nome                 Nome dell'utente
 * @apiSuccess {String}                                 utente.username             Username dell'utente
 * @apiSuccess {String='AGENTE','ISPETTORE','CAPOAREA'} utente.ruolo                Ruolo dell'utente
 * @apiSuccess {Object[]}                               utente.cliente              Lista dei clienti (punti vendita) associati all'utente
 * @apiSuccess {String}                                 utente.cliente.id           Id cliente    
 * @apiSuccess {String}                                 utente.cliente.nome         Nome del cliente    
 * @apiSuccess {String}                                 utente.cliente.cognome      Cognome del cliente    
 * @apiSuccess {String}                                 utente.cliente.via          Indirizzo del cliente (via)
 * @apiSuccess {String}                                 utente.cliente.cap          Indirizzo del cliente (cap)
 * @apiSuccess {String}                                 utente.cliente.citta        Indirizzo del cliente (citta)
 * @apiSuccess {String}                                 utente.cliente.provincia    Indirizzo del cliente (provincia)
 * @apiSuccess {String}                                 utente.cliente.cod_fisc     Codice fiscale/PIVA del cliente
 * 
 * @apiSuccessExample Success-Response:
 * 
 * {
 *   "request_time": "Tue May 10 11:25:31 CEST 2016",
 *   "code": 200,
 *   "response_time": "Tue May 10 11:25:31 CEST 2016",
 *   "status": "success",
 *   "utente":    {
 *      "id": "282",
 *      "username": "userisp9490",
 *      "ruolo": "ISPETTORE",
 *      "id_agente": null,
 *      "id_ispettore": "20",
 *      "id_capoarea": null,
 *      "cliente":       [
 *                  {
 *            "id": "373",
 *            "cod_cliente": "30918",
 *            "nome": "AGI MARKET S.N.C. DI BULLA GIROLAMO & C.",
 *            "cognome": null,
 *            "via": "VIA DANTE 5/B",
 *            "cap": "25020",
 *            "citta": "DELLO",
 *            "provincia": "BS",
 *            "cod_fisc": "629610981",
 *            "id_agente": "55",
 *            "id_ispettore": "20",
 *            "id_capoarea": "2"
 *         },
 *         {
 *            "id": "748",
 *            "cod_cliente": "32053",
 *            "nome": "ALIMENTARI TIRABOSCHI",
 *            "cognome": "ROBERTO S.N.C.",
 *            "via": "VIA PERLETTI 1",
 *            "cap": "24013",
 *            "citta": "OLTRE IL COLLE",
 *            "provincia": "BG",
 *            "cod_fisc": "1630860169",
 *            "id_agente": "48",
 *            "id_ispettore": "20",
 *            "id_capoarea": "2"
 *         }
 *      ]
 *   }
 * } 
 * */
class UserController extends AbstractController {

    private $userService;
    private $contrattinoService;
    private $clienteService;

    public function __construct($request) {
        parent::__construct($request);
        $this->userService = new UserService();
        $this->contrattinoService = new ContrattinoService();
        $this->clienteService = new ClienteService();
    }

    public function getAction() {
        if (isset($this->request->url_elements [2])) {
            $id = $this->request->url_elements [2];
            if (isset($this->request->url_elements [3])) {
                $action = $this->request->url_elements [3];
                if ($action == 'contrattino') {
                    $parameters = $this->request->parameters;
                    $filtro = (isset($parameters['filtro']) ? $parameters['filtro'] : '');
                    $res = $this->contrattinoService->readByUser($id, $filtro);

                    $message = null;
                    if (isset($res['error'])) {
                        $message = $res['message'];
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    }
                    $this->getResultData($res, 'contrattino', $message);
                } else if ($action == 'elencoclienti') {
                    $parameters = $this->request->parameters;
                    $application = $parameters['application'];
                    $itemsPerPage = (isset($parameters['itemsPerPage']) ? $parameters['itemsPerPage'] : 2000);
                    $currentPage = (isset($parameters['currentPage']) ? $parameters['currentPage'] : -1);
                    $localita = (isset($parameters['localita']) ? $parameters['localita'] : '');
                    $provincia = (isset($parameters['provincia']) ? $parameters['provincia'] : '');

                    $res = $this->clienteService->elencoClienti($id, $application, $itemsPerPage, $currentPage, $localita, $provincia);
                    $message = null;
                    if (isset($res['error'])) {
                        $message = $res['message'];
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                    }
                    $this->getResultData($res, 'elencoclienti', $message);
                } else if ($action = 'gerarchia') {
                    $parameters = $this->request->parameters;
                    $livello = $parameters['livello'];
                    if ($livello != 'AGENTE' && $livello != 'ISPETTORE') {
                        $this->data['code'] = AbstractController::HTTP_CODE_NOTALLOWED;
                    } else {
                        $res = $this->userService->leggiGerarchia($id, $livello);
                        $message = null;
                        if (isset($res['error'])) {
                            $message = $res['message'];
                            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                        }
                        $this->getResultData($res, 'gerarchia', $message);
                    }
                }
            } else {
                $res = $this->userService->readByID($id);
                $message = null;
                if (isset($res['error'])) {
                    $message = $res['message'];
                    $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                }
                $this->getResultData($res, 'utente', $message);
            }
        } else {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTALLOWED;
        }
        return $this->data;
    }

    public function postAction() {
        $action = $this->request->url_elements[2];
        if ($action == "login") {
            $parameters = $this->request->parameters;
            $res = $this->userService->login($parameters['username'], $parameters['password'], $parameters['application']);
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
            }
            $this->getResultData($res, 'utente', null);
            //$this->getResultData($parameters, 'utente', null);
        } else {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        }
        return $this->data;
    }

    public function deleteAction() {
        
    }

    public function putAction() {
        $parameters = $this->request->parameters;
        $res = $this->userService->update($parameters);
        if (isset($res['error'])) {
            $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
        } 
        $this->getResultData($res, 'utente', null);
        return $this->data;        
    }

}
