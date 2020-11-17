<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'namespace' => 'Qihucms\SiteHelp\Controllers\Api',
    'prefix' => 'site-help',
    'middleware' => ['api'],
    'as' => 'api.'
], function (Router $router) {
    // 后台选择文档
    $router->get('select-helps', 'HelpController@findByQ')->name('site-help.select');
    // 文档读取
    $router->get('helps', 'HelpController@index')->name('help.index');
    $router->get('helps/{id}', 'HelpController@show')->name('help.show');
    // 文档分类
    $router->get('help-categories', 'CategoryController@index')->name('help.category.index');
    $router->get('help-categories/{id}', 'CategoryController@show')->name('help.category.show');
    // 文档评论
    $router->resource('help-replies', 'ReplyController');
});

// 后台
Route::group([
    'prefix' => config('admin.route.prefix') . '/site-help',
    'namespace' => 'Qihucms\SiteHelp\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
    $router->resource('help-categories', 'HelpCategoryController');
    $router->resource('helps', 'HelpController');
    $router->resource('help-replies', 'HelpReplyController');
});