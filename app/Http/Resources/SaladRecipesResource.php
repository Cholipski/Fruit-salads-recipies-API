<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaladRecipesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = "";

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'fruits' => $this->getFruitsName(),
            'total_weight' => $this->getTotalWeight(),
            'total_calories' => $this->getTotalCalories(),
        ];
    }
}
