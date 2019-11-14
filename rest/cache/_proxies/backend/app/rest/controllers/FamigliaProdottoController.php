<?php
namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController as AbstractController;
use backend\app\service\FamigliaProdottoService as FamigliaProdottoService;
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
class FamigliaProdottoController extends FamigliaProdottoController__AopProxied implements \Go\Aop\Proxy
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
\Go\Proxy\ClassProxy::injectJoinPoints('backend\app\rest\controllers\FamigliaProdottoController',array (
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