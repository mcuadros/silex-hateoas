<?php
namespace SilexHal\Controllers;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use SilexHal\ResourceResponse;

class ResourceHub {

    public function index(Application $app) {
        $root = $app['hal']('/');
        foreach($app['resourcehub']->getAll() as $resource) {
            $metadata = $resource->getMetadata();
            $hal = $app['hal'](
                '/' . $metadata['name'],
                $metadata
            );

            $root->addResource('resource', $hal);
        }

        return ResourceResponse::create($root);

     
        exit();


        
        $hal->addLink('next', '/orders?page=2');
        $hal->addLink('search', '/orders?id={order_id}');

        $resource = $app['hal'](
            '/orders/123',
            array(
                'total' => 30.00,
                'currency' => 'USD',
            )
        );

        $resource->addLink('customer', '/customer/bob', array('title' => 'Bob Jones <bob@jones.com>'));
        $hal->addResource('order', $resource);

        return ResourceResponse::create($hal);
    }

    public function resource(Application $app, Request $request)
    {
        $params = $request->attributes->all();

        $route = explode(':', $params['_route']);
        $hal = $app['resourcehub']->get($route[0])->{$route[1]}();
        return ResourceResponse::create($hal);
    }
}
