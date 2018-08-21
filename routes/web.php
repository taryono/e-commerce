<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
    $crafts = \App\Models\Craft::all();
    return view('welcome', compact('crafts'));
})->name('welcome');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'Admin\AdminController@index')->name('admin');
//php artisan make:controller PhotoController --resource --model=Photo
/*
 * Actions Handled By Resource Controller
  Verb	URI                     Action      Route Name
  GET	/photos                 index       photos.index
  GET	/photos/create          create      photos.create
  POST	/photos                 store       photos.store
  GET	/photos/{photo}         show        photos.show
  GET	/photos/{photo}/edit	edit        photos.edit
  PUT/PATCH	/photos/{photo}	update      photos.update
  DELETE	/photos/{photo}         destroy     photos.destroy
 */
$menus = \App\Models\Menu::where('is_show', 1)->get();

foreach ($menus as $m) {
    if ($m->method == "get") {
        Route::get($m->name, $m->controller->name . $m->action)->name($m->route);
    }else{
        Route::post($m->name, $m->controller->name . $m->action)->name($m->route);
    }
} 
Route::get('/detail/{id}', ['as' => 'product.detail', 'uses' => 'ProductController@detail']);
Route::get('comment/getUsers', 'CommentController@getUsers');
Route::get('comment/list_comments/{craft_id}', 'CommentController@list_comments');
Route::get('cart/list_by_cart/{cart_id}', ['as'=> 'cart.list_by_cart', 'uses'=> 'Customer\CartController@list_by_cart']);
Route::get('cart/update_cart/{cart_detail_id}', ['as'=> 'cart.update_cart', 'uses'=> 'Customer\CartController@get_cart_detail']);
Route::put('cart/update_cart_detail/{cart_detail_id}', ['as'=> 'cart.update_cart_detail', 'uses'=> 'Customer\CartController@update_cart_detail']);
Route::delete('cart/delete_cart/{cart_detail_id}', ['as'=> 'cart.delete_cart', 'uses'=> 'Customer\CartController@delete_cart_detail']);
Route::get('cart/paid/{cart_id}', ['as'=> 'cart.paid', 'uses'=> 'Customer\CartController@paid']);

$controllers = \App\Models\Controller::all();
foreach ($controllers as $controller) {
    //Route::resource($controller->title, $controller->name); 
    /* Backend post resource */
    $title = $controller->title;
    $name = $controller->name;
    /*
    $as = $controller->as;
    $middleware = strpos($controller->middleware, ',') ? explode(',', $controller->middleware) : $controller->middleware;
    $router->group(['middleware' => $middleware, 'prefix' => $controller->prefix], function ($router) use ($title, $name, $as) {
        $router->resource($title, $name, ['as' => $as]);
    });
     * 
     */

    // Frontend post resource
    $router->resource($title, $name);
}


