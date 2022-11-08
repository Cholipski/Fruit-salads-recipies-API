<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaladRecipesRequest;
use App\Models\SaladRecipes;

class SaladController extends Controller
{
    public function store(StoreSaladRecipesRequest $request){
        try{
            $input = $request->all();
            $recipe = SaladRecipes::create([
                'name' => $input['name'],
                'description' => $input['description']
            ]);
            $recipe->fruits()->sync($input['fruits']);

        }catch (\Exception $e){
            print($e);
        }

    }
}
