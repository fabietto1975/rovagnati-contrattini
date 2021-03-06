<?php

namespace backend\app\aop\aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;

use PDOException;

class TransactionAspect implements Aspect {

    /**
     * @param MethodInvocation $invocation Invocation
     * @Around("execution(public backend\app\dao\*DAO->create|update(*))", scope="target")
     */
    public function manageTransaction(MethodInvocation $invocation) {
        $obj = $invocation->getThis();
        $obj->getPdo()->beginTransaction();
        try {
            $res = $invocation->proceed();
            $obj->getPdo()->commit();
            return $res;
        } catch (PDOException $ex){
            $obj->getPdo()->rollback();
            return array (
                'status' => 'KO',
                'message' => $ex->getMessage().' - '.$ex->getTraceAsString()
            );
        }    
    }

}
