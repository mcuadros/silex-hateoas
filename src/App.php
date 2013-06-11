<?php
use SilexHal\Providers\ControllersProvider;
use SilexHal\Providers\ResourceHubProvider;
use Popshack\Silex\Provider\Hal\HalServiceProvider;

$app->register(new HalServiceProvider());
$app->register(new ResourceHubProvider());
$app->register(new ControllersProvider());

return $app;