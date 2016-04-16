<?php namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable = [
		'category_id',
		'name',
		'description',
		'price',
		'featured',
		'recommend'
	];

	public function images()
	{
		return $this->hasMany('CodeCommerce\ProductImage');
	}

	public function category()
	{
		return $this->belongsTo('CodeCommerce\Category');
	}

	public function tags()
	{
		return $this->belongsToMany('CodeCommerce\Tag');
	}

	public function tagToArray($tags)
	{
		$tagBanco = new Tag();
		$tags = explode(',',$tags);
		$tags = array_map('trim',$tags);
		$tagCollection = [];
		foreach($tags as $tag)
		{
			$t = $tagBanco->firstOrCreate(['name'=>$tag]);
			array_push($tagCollection,$t->id);
		}
		return $tagCollection;
	}
	public function getTagListAttribute()
	{
		$arrayTags = array();
		$tags = $this->tags->lists('name')->toArray();
		foreach($tags as $tag)
		{
			array_push($arrayTags,$tag);
		}
		return implode(',',$arrayTags);
	}


	public function scopeFeatured($query)
	{
		return $query->where('featured','=' ,1);
	}

	public function scopeRecommend($query)
	{
		return $query->where('recommend','=' ,1);
	}

	public function scopeOfCategory($query, $type){

		return $query->where('category_id','=' ,$type);

	}








}
