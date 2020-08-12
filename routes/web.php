<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'api'], function () use ($router) {

    // User
    $router->group([
        'prefix'     => 'user',
    ], function () use ($router) {
        // User "/api/register
        $router->post('signup', 'AuthController@register');

        // User "/api/login
        $router->post('login', 'AuthController@login');
    });


    // Currency
    $router->group([
        'prefix'     => 'currencies',
        'middleware' => 'auth',
    ], function () use ($router) {

        $router->get('/', [
            'as'   => 'index',
            'uses' => 'CurrenciesController@index',
        ]);

        $router->get('/index', [
            'as'   => 'index',
            'uses' => 'CurrenciesController@index',
        ]);

        $router->get('/{id}', [
            'middleware' => 'auth:api',
            'as'   => 'show',
            'uses' => 'CurrenciesController@show',
        ]);

    });
});
