<?php
namespace SilexHal\Controllers;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use SilexHal\ResourceResponse;
use Teapot\StatusCode;

class ResourceHub {
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function get(Request $request, $id = null)
    {
        $resource = $this->getResource($request);
        if ( $id ) $result = $resource->getOne($id);
        else $result = $resource->get();

        if ( $result === false ) $status = StatusCode::NOT_FOUND;
        else if ( $result === null ) $status = StatusCode::NO_CONTENT;
        else $status = StatusCode::OK;

        return ResourceResponse::create($result, $status);
    }

    public function post(Request $request, $id)
    {
        $resource = $this->getResource($request);
        $result = $resource->post($id, $request->request->all());

        if ( $result === false ) $status = StatusCode::CONFLICT;
        else if ( $result === null ) $status = StatusCode::NOT_FOUND;
        else $status = StatusCode::OK;

        $value = $resource->getOne($id);
        return ResourceResponse::create($value, $status);
    }

    public function put(Request $request)
    {
        $resource = $this->getResource($request);
        $result = $resource->put($request->request->all());

        if ( !$result ) $status = StatusCode::BAD_REQUEST;
        else $status = StatusCode::CREATED;

        $value = $resource->getOne($result);
        return ResourceResponse::create($value, $status);
    }

    public function delete(Request $request, $id)
    {
        $resource = $this->getResource($request);
        $result = $resource->delete($id);

        if ( $result === false ) $status = StatusCode::NOT_FOUND;
        else if ( $result === null ) $status = StatusCode::NO_CONTENT;
        else $status = StatusCode::OK;

        return ResourceResponse::create(false, $status);
    }

    private function getResource(Request $request)
    {
        $params = $request->attributes->all();

        $route = explode(':', $params['_route']);
        return $this->app['resourcehub']->get($route[0]);
    }
}
