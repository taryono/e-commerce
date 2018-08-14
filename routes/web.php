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
$menus = \App\Models\Menu::where('is_show', 1)->get();

foreach ($menus as $m) {
    if ($m->method == "get") {
        Route::get($m->name, $m->controller->name . $m->action)->name($m->route);
    }else{
        Route::post($m->name, $m->controller->name . $m->action)->name($m->route);
    }
} 
Route::get('/detail/{id}', ['as' => 'product.detail', 'uses' => 'ProductController@detail']);
Route::get('/comments/getComments/{craft_id}', ['as' => 'comments.getComments', 'uses' => 'CommentController@getComments']);
Route::get('/comments/getUsers', ['as' => 'comments.getUsers', 'uses' => 'CommentController@getUsers']);
Route::post('/comments/postComments', ['as' => 'comments.postComments', 'uses' => 'CommentController@postComments']);
Route::put('/comments/putComments/{id}', ['as' => 'comments.putComments', 'uses' => 'CommentController@putComments']);
