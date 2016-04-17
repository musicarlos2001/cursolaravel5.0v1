<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Rotas das Categories */

//Route::pattern('id', '[0-9]+');


Route::get('/', 'StoreController@index');
Route::get('category/{id}',['as' => 'store.category', 'uses' =>'StoreController@category']);
Route::get('product/{id}',['as' => 'store.product', 'uses' =>'StoreController@product']);
Route::get('cart',['as' => 'cart', 'uses' =>'CartController@index']);

Route::group(['prefix' => 'admin', 'where'=>['id'=>'[0-9]+']], function() {

	Route::group(['prefix' => 'categories'], function() {

		Route::get('/', ['as'=>'categories', 'uses'=>'CategoriesController@index']);

		Route::get('create', ['as'=>'categories.create', 'uses'=> 'CategoriesController@create']);

		Route::post('/',['as'=>'categories.store', 'uses'=> 'CategoriesController@store']);

		Route::get('{id}/edit',['as'=>'categories.edit', 'uses'=> 'CategoriesController@edit']);

		Route::put('{id}/update',['as'=>'categories.update', 'uses'=> 'CategoriesController@update']);

		Route::get('{id}/destroy',['as'=>'categories.destroy', 'uses'=> 'CategoriesController@destroy']);



	});




	Route::group(['prefix' => 'products'], function() {

		Route::get('/', ['as'=>'products', 'uses'=>'ProductsController@index']);

		Route::get('create', ['as'=>'products.create', 'uses'=> 'ProductsController@create']);


		Route::post('/',['as'=>'products.store', 'uses'=> 'ProductsController@store']);

		Route::get('{id}/edit',['as'=>'products.edit', 'uses'=> 'ProductsController@edit']);

		Route::put('{id}/update',['as'=>'products.update', 'uses'=> 'ProductsController@update']);

		Route::get('{id}/destroy',['as'=>'products.destroy', 'uses'=> 'ProductsController@destroy']);

		Route::group(['prefix' => 'images'], function() {
			//localhost:80000/admin/products/images/{id}/product
			Route::get('{id}/product', ['as'=>'products.images', 'uses'=>'ProductsController@images']);
			//http://localhost:8000/admin/products/images/create/1/product
			Route::get('create/{id}/product', ['as'=>'products.images.create', 'uses'=>'ProductsController@createImage']);
			Route::post('store/{id}/product', ['as'=>'products.images.store', 'uses'=>'ProductsController@storeImage']);
			Route::get('destroy/{id}/image', ['as'=>'products.images.destroy', 'uses'=>'ProductsController@destroyImage']);


		});

	});


});




/*



Route::get('buscarendereco', 'ProductsController@endereco');






Route::group(['prefix' => 'admin'], function() {
	Route::group(['prefix' => 'categories'], function() {
		Route::get('/', 'AdminCategoriesController@index');

	});

	Route::group(['prefix' => 'products'], function(){
		Route::get('/', 'AdminProductsController@index');

	});

	Route::group(['prefix' => 'categories'], function(){
		Route::get('/{id}', function($id){

			$category = new \CodeCommerce\Category();
			$c = $category->find($id);
			return "Nome: ". $c->name ."<br/>".
					"Descrição:" .$c->description;

		});
	});


	Route::group(['prefix' => 'products'], function(){
		Route::get('/{id}', function($id){

			$product = new \CodeCommerce\Product();
			$p = $product->find($id);
			return "Nome:" .$p->name ."<br/>".
			       "Descrição:" .$p->description ."<br/>".
			       "Preço:" .$p->price;

		});

	});



});






Route::get('category/{category}', function(\CodeCommerce\Category $category){
	return $category->name ."<br/>". $category->description;
});

Route::get('product/{id}', function($id){

	$product = new \CodeCommerce\Product();
	$p = $product->find($id);
	return $p->name ."<br/>". $p->description;

});

Route::get('user/{id?}', function($id = 0){

	if($id)
		return "Olá $id";
	return "Não Possui ID";

})->where('id', '[0-9]+');

Route::get('testando',['as'=>'produtos', function(){
	echo Route::currentRouteName();
		//return "rotas";

}]);


//redirect()->route('produtos');
//echo route('produtos');die;

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('/exemplo', 'WelcomeController@exemplo');

//Route::get('admin/categories', 'AdminCategoriesController@index');

//Route::get('admin/products', 'AdminProductsController@index');


*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
