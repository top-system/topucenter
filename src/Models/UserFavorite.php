<?php

namespace TopSystem\UCenter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TopSystem\TopAdmin\Facades\Admin;
use TopSystem\TopAdmin\Traits\Translatable;

class UserFavorite extends Model
{
    use Translatable;

    protected $translatable = ['title'];

    protected $fillable = ['user_id', 'title','thumbnail','url','description','table_name','object_id'];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->user_id && Auth::user()) {
            $this->user_id = Auth::user()->getKey();
        }
        return parent::save();
    }
}
