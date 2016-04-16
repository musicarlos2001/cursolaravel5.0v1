<?php namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use Cagartner\CorreiosConsulta\CorreiosConsulta;
use CodeCommerce\ProductImage;
use CodeCommerce\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductsController extends Controller {

	private $productModel;

	public function __construct(Product $productModel)
	{
		$this->productModel = $productModel;
	}

	public function index(){


		$products = $this->productModel->paginate(10);

		return view('products.index', compact('products'));
	}

	public function create(Category $category, Tag $tag){

		$tags = $tag->lists('name','id');

		$categories = $category->lists('name','id');

		return view('products.create', compact('categories', 'tags'));
	}

	private function storeTag($inputTags, $id)
	{
		$tagsIDs = array_map(function($tagName) {
			return Tag::firstOrCreate(['name' => $tagName])->id;
		}, array_filter($inputTags));

		$product = $this->productModel->find($id);
		$product->tags()->sync($tagsIDs);

	}


	public function store(Requests\ProductRequest $request)
	{

		$product = $this->productModel->fill($request->all());

		$product->save();

		$inputTags = array_map('trim', explode(',', $request->get('tags')));

		$this->storeTag($inputTags,$product->id);

		return redirect()->route('products');

	}


	public function edit($id, Category $category){

        $categories = $category->lists('name','id');

		$product = $this->productModel->find($id);

		return view('products.edit', compact('product','categories'));
	}

	public function update(Requests\ProductRequest $request, $id){

		$this->productModel->find($id)->update($request->all());
		$inputTags = array_map('trim', explode(',', $request->get('tags')));
		if($inputTags) {
			$this->storeTag($inputTags, $id);
			return redirect()->route('products');
		}
		else

		return redirect()->route('products');
	}


	public function destroy($id){
		$this->productModel->find($id)->delete();
		return redirect()->route('products');
	}

	public function images($id){

		$product = $this->productModel->find($id);

		return view('products.images', compact('product'));
	}

	public function createImage($id){
		$product = $this->productModel->find($id);

		return view('products.create_image', compact('product'));
	}

	public function storeImage(Requests\ProductImageRequest $request ,$id, ProductImage $productImage){

		$file = $request->file('image');
		$extension = $file->getClientOriginalExtension();
		$image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);
		Storage::disk('public_local')->put($image->id.'.'.$extension, File::get($file));

		return redirect()->route('products.images', ['id'=>$id]);
	}

	public function destroyImage($id, ProductImage $productImage){

		$image = $productImage->find($id);

		if(file_exists(public_path().'/uploads/'.$image->id.'.'.$image->extension)){
			Storage::disk('public_local')->delete($image->id.'.'.$image->extension);
		}


		$product = $image->product;
		$image->delete();

		return redirect()->route('products.images', ['id'=>$product->id]);
	}



}
