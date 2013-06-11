<?php
namespace SilexHal\Providers;
use Symfony\Component\HttpFoundation\Request;
use Silex\ServiceProviderInterface;
use Silex\Application;

use SilexHal\Controllers\ResourceHub;

class ControllersProvider implements ServiceProviderInterface {

    public function register(Application $app) {
        $app->match('/', 'SilexHal\Controllers\ResourceHub::index')->bind('index');
    }

    public function boot(Application $app) {

    }
}
