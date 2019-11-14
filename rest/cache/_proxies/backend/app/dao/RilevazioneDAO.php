<?php
namespace backend\app\dao;

use backend\common\dao\DAOAbstract as DAOAbstract;
use backend\common\dao\DAOInterface as DAOInterface;

class RilevazioneDAO extends RilevazioneDAO__AopProxied implements \Go\Aop\Proxy
{

    /**
     * Property was created automatically, do not change it manually
     */
    private static $__joinPoints = array();
    
    
    public function create($schedaRilevazione)
    {
        return self::$__joinPoints['method:create']->__invoke($this, array($schedaRilevazione));
    }
    
    
    public function update($schedaRilevazione)
    {
        return self::$__joinPoints['method:update']->__invoke($this, array($schedaRilevazione));
    }
    
}
\Go\Proxy\ClassProxy::injectJoinPoints('backend\app\dao\RilevazioneDAO',array (
  'method' => 
  array (
    'create' => 
    array (
      0 => 'advisor.backend\\app\\aop\\aspects\\TransactionAspect->manageTransaction',
    ),
    'update' => 
    array (
      0 => 'advisor.backend\\app\\aop\\aspects\\TransactionAspect->manageTransaction',
    ),
  ),
));