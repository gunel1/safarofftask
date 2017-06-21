<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }

    public function parentCategory()
    {
        return $this->hasOne('App\Category', 'id', 'parent_id');
    }

    public function subCategory() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }

    public function delete()

    {
$this->blogs()->delete();
            $this->subCategory()->delete();
            parent::delete();
    }

}
