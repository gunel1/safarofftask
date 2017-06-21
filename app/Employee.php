<?php

namespace App;

use Faker\Provider\Image;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    public function delete()

    {

       if (isset($this->image)) {
           $imageName = $this->image->url;
           $file_path = public_path('images/employees/') . $imageName;
           if (file_exists("$file_path")) {
               @unlink("$file_path");
           }
           $this->image()->delete();
       }

        parent::delete();
    }


    public function image()
    {
        return $this->hasOne('App\Image', 'id', 'image_id');
    }
}
