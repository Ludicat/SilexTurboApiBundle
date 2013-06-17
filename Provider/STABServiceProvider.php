<?php

namespace Devolicious\SilexTurboApiBundle\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class STABServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app->register(new RoutingServiceProvider());
        $app->register(new DIServiceProvider());

        $app['container']->get('stab.annotation.loader')->registerAnnotations();
    }

    public function boot(Application $app)
    {}
}