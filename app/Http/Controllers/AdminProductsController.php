<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Product;

class AdminProductsController extends Controller {

	private $products;
	public function __construct(Product $products)
	{
		$this->middleware('guest');
		$this->products = $products;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = $this->products->all();
		return view('products', compact('products'));
	}

	

}
