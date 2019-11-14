<?php
namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController as AbstractController;
use backend\app\service\ConcorrenteService as ConcorrenteService;
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
class ConcorrenteController extends ConcorrenteController__AopProxied implements \Go\Aop\Proxy
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
\Go\Proxy\ClassProxy::injectJoinPoints('backend\app\rest\controllers\ConcorrenteController',array (
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