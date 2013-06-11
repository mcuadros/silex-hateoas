<?php
namespace SilexHal\Services;
use SilexHal\Resources\Resource;
use Silex\Application;

class ResourceHub {
    private $resources = array();

    public function add(Resource $resource)
    {
        $this->resources[$resource->getURI()] = $resource;
        return true;
    }

    public function has($uri)
    {
        return isset($this->resources[$uri]);
    }

    public function get($uri) {
        if ( isset($this->resources[$uri]) ) return $this->resources[$uri];
        return false;
    }

    public function getAll()
    {
        return $this->resources;
    }

    public function registerAll(Application $app)
    {
        foreach($this->resources as $uri => $resource) {
            $this->register($app, $uri);
        }
    }

    public function register(Application $app, $uri)
    {
        $resource = $this->get($uri);
        $metadata = $resource->getMetadata();
        $base = '/' . $uri;

        if ( is_callable(array($resource, 'get')) ) {
            $app
                ->get($base, 'SilexHal\Controllers\ResourceHub::resource')
                ->bind($uri . ':get');
        }

        if ( is_callable(array($resource, 'post')) ) {
            $app
                ->post($base . '/{id}', 'SilexHal\Controllers\ResourceHub::resource')
                ->bind($uri . ':post');
        }

        if ( is_callable(array($resource, 'put')) ) {
            $app
                ->put($base.'/{id}', 'SilexHal\Controllers\ResourceHub::resource')
                ->bind($uri . ':put');
        }

        if ( is_callable(array($resource, 'delete')) ) {
            $app
                ->delete($base.'/{id}', 'SilexHal\Controllers\ResourceHub::resource')
                ->bind($uri . ':delete');
        }
    }
}
