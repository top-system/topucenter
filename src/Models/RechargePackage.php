<?php

namespace TopSystem\UCenter\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TopSystem\TopAdmin\Facades\Admin;
use TopSystem\TopAdmin\Traits\Resizable;
use TopSystem\TopAdmin\Traits\Translatable;

class RechargePackage extends Model
{
    use Translatable;
    use Resizable;

    protected $translatable = ['name', 'description', 'value', 'type', 'status', 'expire_at','amount'];

    protected $guarded = [];

}
