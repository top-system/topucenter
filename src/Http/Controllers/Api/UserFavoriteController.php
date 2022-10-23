<?php

namespace TopSystem\UCenter\Http\Controllers\Api;

use Illuminate\Http\Request;
use TopSystem\UCenter\Http\Controllers\BaseController;
use TopSystem\UCenter\Models\UserFavorite;

class UserFavoriteController extends BaseController {

    public function doFavorite(Request $request){
        UserFavorite::create([
            'title' => $request->title,
            'thumbnail' => $request->thumbnail,
            'url' => $request->url,
            'description' => $request->description,
            'table_name' => $request->table_name,
            'object_id' => $request->object_id
        ]);
    }

    public function cancelFavorite(Request $request){
        UserFavorite::where('table_name',$request->table_name)->where('object_id',$request->object_id)->delete();
    }
    
}