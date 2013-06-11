<?php
namespace SilexHal\Resources;
use Nocarrier\Hal;

class Articles extends Resource {
    public function __construct()
    {
        $this->setURI('articles');
        $this->setName('articles');
        $this->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut');
    }

    public function get()
    {
        $hal = new Hal('/test');
        $hal->addLink('next', '/orders?page=2');
        $hal->addLink('search', '/orders?id={order_id}');

        $resource = new Hal(
            '/orders/123',
            array(
                'total' => 30.00,
                'currency' => 'USD',
            )
        );

        $hal->addResource('order', $resource);
        return $hal;
    }
}