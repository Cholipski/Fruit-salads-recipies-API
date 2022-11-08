<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FruitResource extends JsonResource
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
            'nutrients' => [
                'carbohydrates' => $this->carbohydrates,
                'protein' => $this->protein,
                'fat' => $this->fat,
                'calories' => $this->calories,
                'sugar' => $this->sugar,
            ]
        ];
    }
}
