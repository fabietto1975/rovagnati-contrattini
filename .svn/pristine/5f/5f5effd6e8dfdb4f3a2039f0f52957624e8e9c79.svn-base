<?php
// app/ApplicationAspectKernbel.php
namespace backend\app\aop;

use Go\Core\AspectKernel;
use Go\Core\AspectContainer;

use backend\app\aop\aspects\SecurityAspect;
use backend\app\aop\aspects\TransactionAspect;
/**
 * Application Aspect Kernel
 */
class ApplicationAspectKernel extends AspectKernel
{

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container) {
        $container->registerAspect(new SecurityAspect());
        $container->registerAspect(new TransactionAspect());
    }
}