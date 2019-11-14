<?php
namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController as AbstractController;
use backend\app\service\ContrattinoService as ContrattinoService;
/**
 * @api {get} /rest/contrattino/:user_id (a) Elenco contrattini
 * @apiName Contrattino
 * @apiGroup GetContrattino
 * 
 *
 */
class ContrattinoController extends ContrattinoController__AopProxied implements \Go\Aop\Proxy
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
\Go\Proxy\ClassProxy::injectJoinPoints('backend\app\rest\controllers\ContrattinoController',array (
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