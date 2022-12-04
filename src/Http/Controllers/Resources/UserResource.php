<?php

namespace TopSystem\UCenter\Http\Controllers\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->vip <= 0 || $this->vip_expire_at < date('Y-m-d H:i:s')){
            $this->vip = 0;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'amount' => $this->amount,
            'birthdate' => $this->birthdate,
            'sex' => $this->sex,
            'vip' => $this->vip,
            'mobile' => $this->mobile,
            'roles' => array_map(
                function ($role) {
                    return $role['name'];
                },
                $this->roles->toArray()
            ),
            'token' => $this->createToken('default')->plainTextToken,
            'avatar' => $this->avatar,
        ];
    }
}