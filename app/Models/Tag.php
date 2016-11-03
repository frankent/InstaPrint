<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $table = 'tag';
//	public $id;
	public $name;
	public $is_active;
//	public $created_at;
//	public $updated_at;
}
