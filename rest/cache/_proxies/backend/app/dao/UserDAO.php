<?php
namespace backend\app\dao;

use backend\common\dao\DAOAbstract as DAOAbstract;
use backend\common\dao\DAOInterface as DAOInterface;

class UserDAO extends UserDAO__AopProxied implements \Go\Aop\Proxy
{

    /**
     * Property was created automatically, do not change it manually
     */
    private static $__joinPoints = array();
    
    
    public function create($item)
    {
        return self::$__joinPoints['method:create']->__invoke($this, array($item));
    }
    
    
    public function update($user)
    {
        return self::$__joinPoints['method:update']->__invoke($this, array($user));
    }
    
}
\Go\Proxy\ClassProxy::injectJoinPoints('backend\app\dao\UserDAO',array (
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