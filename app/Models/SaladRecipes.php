<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaladRecipes extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "description",
        "carbohydrates",
        "protein",
        "fat",
        "calories",
        "sugar"
    ];

    public function fruits()
    {
        return $this->belongsToMany(Fruit::class,'salad_fruits',
            "recipe_id","fruit_id")->withPivot(['weight']);
    }

    public function getFruitsName(): array
    {
        $names = [];
        foreach ($this->fruits()->get() as $fruit) {
            $names[] = $fruit->name;
        }
        return $names;
    }

    public function getTotalWeight(): float
    {
        $sum = 0;
        foreach ($this->fruits()->get() as $fruit){
            $sum+= $fruit->pivot->weight;
        }
        return $sum;
    }

    public function getTotalCalories(): int
    {
        $sum = 0;
        foreach ($this->fruits()->get() as $fruit){
            $sum+= $fruit->calories;
        }
        return $sum;
    }
}
