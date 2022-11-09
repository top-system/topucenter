<?php

namespace TopSystem\UCenter\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TopSystem\TopAdmin\Facades\Admin;
use TopSystem\TopAdmin\Traits\Resizable;
use TopSystem\TopAdmin\Traits\Translatable;

class PaymentOrder extends Model
{
    use Translatable;
    use Resizable;

    protected $translatable = ['user_id', 'app_id', 'gateway', 'channel', 'currency', 'trade_no', 'amount', 'status', 'description', 'request_ip', 'extend'];

    public const PUBLISHED = 'PUBLISHED';

    protected $guarded = [];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->user_id && Auth::user()) {
            $this->user_id = Auth::user()->getKey();
        }
        if (!$this->status){
            $this->status = 0;
        }

        return parent::save();
    }

    public function authorId()
    {
        return $this->belongsTo(Admin::modelClass('User'), 'user_id', 'id');
    }

}
