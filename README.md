Silex RESTful HATEOAS Service
=============================

This is a little example of how build a RESTful HATEOAS Service on Silex.


Requirements
------------

* PHP 5.3.x;
* silex/silex 
* nocarrier/hal
* shrikeh/teapot
* popshack/silex-hal-serviceprovider


Installation
------------

The recommended way of installing this example is [through composer](http://getcomposer.org).
You can see [package information on Packagist.](https://packagist.org/packages/mcuadros/silex-hateoas)

```sh
git clone https://github.com/mcuadros/silex-hateoas silex-hateoas
cd silex-hateoas
git checkout basic
composer install
```


Examples
--------
You can run the example project with the built-in PHP server with:
```sh
php -S 0.0.0.0:8080 index.php
```

### Retrieving all the resources

```sh
curl http://localhost:8080/articles -X GET -i
```

```js
HTTP/1.1 200 OK
Host: localhost:8080
Connection: close
X-Powered-By: PHP/5.4.12
Cache-Control: no-cache
Date: Wed, 12 Jun 2013 13:57:22 GMT
Content-Type: application/hal+json

{
  "_links": {
    "self": {
      "href": "\/articles"
    },
    "search": {
      "href": "\/articles\/{order_id}"
    }
  },
  "_embedded": {
    "article": [
      {
        "id": 1,
        "title": "foo",
        "author": "bar",
        "votes": 121,
        "_links": {
          "self": {
            "href": "\/articles\/1"
          }
        }
      },
      {
        "id": 2,
        "title": "qux",
        "author": "baz",
        "votes": 423,
        "_links": {
          "self": {
            "href": "\/articles\/2"
          }
        }
      },
      {
        "id": 3,
        "title": "bar",
        "author": "qux",
        "votes": 23,
        "_links": {
          "self": {
            "href": "\/articles\/3"
          }
        }
      }
    ]
  }
}
```

### Retrieving one resource

```sh
curl http://localhost:8080/articles/1 -X GET -i
```

```js
HTTP/1.1 200 OK
Host: localhost:8080
Connection: close
X-Powered-By: PHP/5.4.12
Cache-Control: no-cache
Date: Wed, 12 Jun 2013 14:14:05 GMT
Content-Type: application/hal+json

{
  "id": 1,
  "title": "foo",
  "author": "bar",
  "votes": 121,
  "_links": {
    "self": {
      "href": "\/articles\/1"
    }
  }
}
```

### Creating a resource

```sh
curl http://localhost:8080/articles -X PUT -i -d "title=HATEOAS%20Restful%20Demo&author=Mximo%20Cuadros"
```

```js
HTTP/1.1 201 Created
Host: localhost:8080
Connection: close
X-Powered-By: PHP/5.4.12
Cache-Control: no-cache
Date: Wed, 12 Jun 2013 14:00:08 GMT
Content-Type: application/hal+json

{
  "title": "HATEOAS Restful Demo",
  "author": "Mximo Cuadros",
  "_links": {
    "self": {
      "href": "\/articles\/4"
    }
  }
}
```

### Modifying a resource

```sh
curl http://localhost:8080/articles/1 -X POST -i -d "author=Maximo%20Cuadros"
```

```js
HTTP/1.1 201 Created
Host: localhost:8080
Connection: close
X-Powered-By: PHP/5.4.12
Cache-Control: no-cache
Date: Wed, 12 Jun 2013 14:00:08 GMT
Content-Type: application/hal+json

{
  "id": 1,
  "title": "foo",
  "author": "Maximo Cuadros",
  "votes": 121,
  "_links": {
    "self": {
      "href": "\/articles\/1"
    }
  }
}
```

### Delete a resource

```sh
curl http://localhost:8080/articles/1 -X DELETE -i"
```

```js
HTTP/1.1 200 OK
Host: localhost:8080
Connection: close
X-Powered-By: PHP/5.4.12
Cache-Control: no-cache
Date: Wed, 12 Jun 2013 14:04:53 GMT
Content-Type: application/hal+json

```


License
-------

MIT, see [LICENSE](LICENSE)
