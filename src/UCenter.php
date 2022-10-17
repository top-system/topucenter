<?php

namespace TopSystem\UCenter;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use TopSystem\TopAdmin\Events\AlertsCollection;
use Arrilot\Widgets\Facade as Widget;

class UCenter
{

    public function __construct()
    {

    }

    public function routes()
    {
        require __DIR__.'/../routes/ucenter.php';
    }
}