<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;

class AdminCategoriesController extends Controller {

	private $categories;
	public function __construct(Category $category)
	{
		$this->middleware('guest');
		$this->categories = $category;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = $this->categories->all();
		return view('categories', compact('categories'));
	}

	

}
