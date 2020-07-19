<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Each category may have one parent
    public function parent() {
        return $this->belongsToOne(static::class, 'parent_category');
    }

    // Each category may have multiple children
    public function children() {
        return $this->hasMany(static::class, 'parent_category');
    }

    // recursive, loads all descendants
	public function childrenRecursive()
	{
	   return $this->children()->with('childrenRecursive');
	}
}
