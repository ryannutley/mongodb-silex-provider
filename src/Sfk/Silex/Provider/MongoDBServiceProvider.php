<?php

namespace Sfk\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * MongoDBServiceProvider
 */
class MongoDBServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['mongodb.server'] = null;
        $app['mongodb.options'] = array();
        $app['mongodb.client_class'] = 'MongoClient';

        $app['mongodb.client'] = $app->share(function () use ($app) {
            return new $app['mongodb.client_class']($app['mongodb.server'], $app['mongodb.options']);
        });

        $app['mongodb'] = $app->share(function () use ($app) {
            $dbName = isset($app['mongodb.options']['db']) ? $app['mongodb.options']['db'] : null;
            if (null === $dbName) {
                $urlInfo = parse_url($app['mongodb.server']);
                if (isset($urlInfo['path'])) {
                    $dbName = ltrim($urlInfo['path'], '/');
                }
            }

            return $app['mongodb.client']->selectDB($dbName);
        });
    }

    public function boot(Application $app)
    {

    }
}