<?php
namespace SilexHal\Providers;
use Symfony\Component\HttpFoundation\Request;
use Silex\ServiceProviderInterface;
use Silex\Application;

use SilexHal\Controllers\ResourceHub;

class ControllersProvider implements ServiceProviderInterface {

    public function register(Application $app)
    {
        $app['controller.resourcehub'] = $app->share(function() use ($app) {
            return new ResourceHub($app);
        });
    }

    public function boot(Application $app) {

    }
}
