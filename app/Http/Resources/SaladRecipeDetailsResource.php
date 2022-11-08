<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaladRecipeDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'total_nutrients' => [
                'carbohydrates' => $this->carbohydrates,
                'protein' => $this->protein,
                'fat' => $this->fat,
                'calories' => $this->calories,
                'sugar' => $this->sugar,
            ],
            'total_weight' => $this->getTotalWeight(),
            'ingredients' => $this->getIngredients()
        ];
    }
    private function getIngredients()
    {
        $fruits = $this->fruits()->get();
        foreach ($fruits as $fruit){
            $ingredients[] = [
                'name' => $fruit->name,
                'weight' => $fruit->pivot->weight,
                'nutrients' =>  [
                    'carbohydrates' => $fruit->carbohydrates,
                    'protein' => $fruit->protein,
                    'fat' => $fruit->fat,
                    'calories' => $fruit->calories,
                    'sugar' => $fruit->sugar,
                ]
            ];
        }
        return $ingredients;
    }
}
