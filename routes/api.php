<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'serializer:array'
], function($api) {

    $api->group([
      'middleware' => 'api.throttle',
      'limit' => config('api.rate_limits.sign.limit'),
      'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
        // 短信验证码
        $api->post('verificationCodes', 'VerificationCodesController@store')
            ->name('api.verificationCodes.store');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');
        // 图片验证码
        $api->post('captchas', 'CaptchasController@store')
            ->name('api.captchas.store');
            // 第三方登录
        $api->post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
            ->name('api.socials.authorizations.store');
        // 登录
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        // 小程序登录
        $api->post('weapp/authorizations', 'AuthorizationsController@weappStore')
            ->name('api.weapp.authorizations.store');
        // 小程序注册
        $api->post('weapp/users', 'UsersController@weappStore')
            ->name('api.weapp.users.store');
        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
            
        // 产品分类
        $api->get('categories', 'CategoriesController@index')
            ->name('api.categories.index');
        // 产品列表
        $api->get('products', 'ProductsController@index')
            ->name('api.products.index');
        // 产品详情
        $api->get('products/{id}', 'ProductsController@show')
            ->name('api.products.show');

    });

      $api->group([
      'middleware' => 'api.throttle',
      'limit' => config('api.rate_limits.access.limit'),
      'expires' => config('api.rate_limits.access.expires'),
      ], function ($api) {
          // 游客可以访问的接口

          // 需要 token 验证的接口
          $api->group(['middleware' => 'api.auth'], function($api) {
              // 当前登录用户信息
              $api->get('user', 'UsersController@me')
                  ->name('api.user.show');
                  // 图片资源
              $api->post('images', 'ImagesController@store')
                  ->name('api.images.store');
              // 当前登录用户权限
              $api->get('user/permissions', 'PermissionsController@index')
                  ->name('api.user.permissions.index');
              // 编辑登录用户信息
              $api->patch('user', 'UsersController@update')
                  ->name('api.user.patch');
                  // 编辑登录用户信息
              $api->put('user', 'UsersController@update')
                  ->name('api.user.update');
          });
      });
});
