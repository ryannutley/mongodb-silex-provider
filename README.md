MongoDB provider for Silex
=======================

## Installation

### Add to ```composer.json```

```javascript
"getme/mongodb-silex-provider": "dev-master"
```

### Register

```php
$app->register(new Sfk\Silex\Provider\MongoDBServiceProvider(), array(
    'mongodb.server' => 'mongodb://username:password@localhost:27017/mydatabase',
    'mongodb.options' => array(
    ),
));
```

Connection options explanation at [http://php.net/manual/en/mongoclient.construct.php](http://php.net/manual/en/mongoclient.construct.php)

Additional options:

- `mongodb.client_class` - Base class name (default: \MongoClient) see example below.

```php
class  MyMongoClient extends \MongoClient {
    // some useful methods
}

$app->register(new Sfk\Silex\Provider\MongoDBServiceProvider(), array(
    // as above
    'mongodb.client_class' => 'MyMongoClient'
));
```

