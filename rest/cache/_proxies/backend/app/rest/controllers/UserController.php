<?php
namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController as AbstractController;
use backend\app\service\UserService as UserService;
use backend\app\service\ContrattinoService as ContrattinoService;
use backend\app\service\ClienteService as ClienteService;
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
class UserController extends UserController__AopProxied implements \Go\Aop\Proxy
{

    /**
     * Property was created automatically, do not change it manually
     */
    private static $__joinPoints = array();
    
    
    public function getAction()
    {
        return self::$__joinPoints['method:getAction']->__invoke($this);
    }
    
    
    public function postAction()
    {
        return self::$__joinPoints['method:postAction']->__invoke($this);
    }
    
    
    public function deleteAction()
    {
        return self::$__joinPoints['method:deleteAction']->__invoke($this);
    }
    
    
    public function putAction()
    {
        return self::$__joinPoints['method:putAction']->__invoke($this);
    }
    
}
\Go\Proxy\ClassProxy::injectJoinPoints('backend\app\rest\controllers\UserController',array (
  'method' => 
  array (
    'getAction' => 
    array (
      0 => 'advisor.backend\\app\\aop\\aspects\\SecurityAspect->checkAuthorization',
    ),
    'postAction' => 
    array (
      0 => 'advisor.backend\\app\\aop\\aspects\\SecurityAspect->checkAuthorization',
    ),
    'deleteAction' => 
    array (
      0 => 'advisor.backend\\app\\aop\\aspects\\SecurityAspect->checkAuthorization',
    ),
    'putAction' => 
    array (
      0 => 'advisor.backend\\app\\aop\\aspects\\SecurityAspect->checkAuthorization',
    ),
  ),
));