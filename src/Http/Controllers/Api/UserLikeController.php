<?php

namespace TopSystem\UCenter\Http\Controllers\Api;

use Illuminate\Http\Request;
use TopSystem\UCenter\Http\Controllers\BaseController;
use TopSystem\UCenter\Models\UserLike;

class UserLikeController extends BaseController {

    public function doLike(Request $request){
        UserLike::create([
            'title' => $request->title,
            'thumbnail' => $request->thumbnail,
            'url' => $request->url,
            'description' => $request->description,
            'table_name' => $request->table_name,
            'object_id' => $request->object_id
        ]);
    }

    public function cancelLike(Request $request){
        UserLike::where('table_name',$request->table_name)->where('object_id',$request->object_id)->delete();
    }

}