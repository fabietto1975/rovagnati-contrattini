<?php

namespace backend\app\aop\aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\FieldAccess;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Around;
use Go\Lang\Annotation\Pointcut;
use Firebase\JWT\JWT;
use Exception;
use backend\common\rest\controllers\AbstractController;

class SecurityAspect implements Aspect {

    /**
     * @param MethodInvocation $invocation Invocation
     * @Around("execution(public backend\app\rest\controllers\*Controller->*Action(*)) && !execution(public backend\app\rest\controllers\TokenController->*Action(*))", scope="target")
     */
    public function checkAuthorization(MethodInvocation $invocation) {
        include(APP_ROOT . '/config/config-local.php');
        if ($token['check'] == 'true') {
            $obj = $invocation->getThis();

            $authHeader = null;
            if (isset($obj->getRequest()->httpheaders['Authorization'])) {
                $authHeader = $obj->getRequest()->httpheaders['Authorization'];
            }
            if ($authHeader) {
                list($jwt) = sscanf($authHeader, 'Bearer %s');
                if ($jwt != null && $jwt != '') {
                    $serverKey = base64_decode($token['serverKey']);
                    try {
                        $token = JWT::decode($jwt, $serverKey, array('HS512'));
                        return $invocation->proceed();
                    } catch (Exception $e) {
                        $obj->setData('code', AbstractController::HTTP_CODE_UNAUTHORIZED);
                        $res = array(
                            'error' => 'Non autorizzato'
                        );
                        $obj->getResultData($res, 'risposta', null);
                        return $obj->getData();
                    }
                } else {
                    $obj->setData('code', AbstractController::HTTP_CODE_BADREQUEST);
                    $res = array(
                        'error' => 'token non presente nella richiesta'
                    );
                    $obj->getResultData($res, 'risposta', null);
                }
            } else {
                $obj->setData('code', AbstractController::HTTP_CODE_BADREQUEST);
                $res = array(
                    'error' => 'token non presente nella richiesta'
                );
                $obj->getResultData($res, 'risposta', null);
            }
            return $obj->getData();
        } else {
            return $invocation->proceed();
        }
    }

}
