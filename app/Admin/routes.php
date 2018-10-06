<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->post('/test/addSections', 'TestController@addSections');
    $router->resource('/test', TestController::class);
    $router->resource('/type', TypeController::class);
    $router->resource('/question', QuestionController::class);
    $router->resource('/answer', AnswerController::class);
    $router->resource('/section', SectionController::class);
    $router->resource('/relation1', DetailSectionController::class);
    $router->resource('/relation2', DetailTestController::class);
});


