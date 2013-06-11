<?php
namespace SilexHal\Providers;
use Symfony\Component\HttpFoundation\Request;
use Silex\ServiceProviderInterface;
use Silex\Application;

use SilexHal\Services\ResourceHub;
use SilexHal\Resources\Articles;

class ResourceHubProvider implements ServiceProviderInterface {

    public function register(Application $app) {
        $app['resource:articles']  = $app->share(function(Application $app) {
            return new Articles;
        });

        $app['resourcehub'] = $app->share(function(Application $app) {
            $hub = new ResourceHub();
            $hub->add($app['resource:articles']);

            return $hub;
        });

        $app['resourcehub']->registerAll($app);
    }

    public function boot(Application $app) {

    }
}
