<?php

namespace App\Services;

use App\Models\SaladRecipes;

class SaladRecipesServices{

    public static function calculateNutrients(SaladRecipes $recipe):void
    {
        $carbohydrates = $protein = $fat = $calories = $sugar = 0;

        $fruits = $recipe->fruits()->get();
        foreach ($fruits as $fruit){
            $carbohydrates += ($fruit->pivot->weight * $fruit->carbohydrates) / 100;
            $protein += ($fruit->pivot->weight * $fruit->protein) / 100;
            $fat += ($fruit->pivot->weight * $fruit->fat) / 100;
            $calories += ($fruit->pivot->weight * $fruit->calories) / 100;
            $sugar += ($fruit->pivot->weight * $fruit->sugar) / 100;
        }

        $recipe->updateOrFail([
            "carbohydrates" => $carbohydrates,
            "protein" => $protein,
            "fat" => $fat,
            "calories" => $calories,
            "sugar" => $sugar
        ]);

    }

}
