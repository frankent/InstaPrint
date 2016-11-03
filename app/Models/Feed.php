<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

	protected $table = 'feed';
//	public $id;
	public $picture_s;
	public $picture_m;
	public $picture_l;
	public $name;
	public $profile_pic;
	public $caption;
	public $post_picture;
	public $post_id;
//	public $created_at;
//	public $updated_at;
	public $tag_id;
	public $post_location;

}
