<?php

namespace TopSystem\UCenter\Models;

use Illuminate\Database\Eloquent\Model;
use TopSystem\TopAdmin\Facades\Admin;
use TopSystem\TopAdmin\Traits\Translatable;

class UserLike extends Model
{
    use Translatable;

    protected $translatable = ['slug', 'name'];

    protected $fillable = ['slug', 'name'];

    public function posts()
    {
        return $this->hasMany(Admin::modelClass('Post'))
            ->published()
            ->orderBy('created_at', 'DESC');
    }

    public function parentId()
    {
        return $this->belongsTo(self::class);
    }
}
