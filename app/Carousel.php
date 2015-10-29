<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
        'on_update'  => true
    );

    protected $fillable = ['title', 'image', 'description', 'language_id'];

    public function language()
    {
        return $this->belongsTo('App\Language');
    }

}
