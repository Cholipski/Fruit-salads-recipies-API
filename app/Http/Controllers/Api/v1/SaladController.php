<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaladRecipesRequest;
use App\Http\Resources\SaladRecipesCollection;
use App\Http\Resources\SaladRecipesResource;
use App\Models\SaladRecipes;
use App\Services\SaladRecipesServices;
use http\Env\Response;

class SaladController extends Controller
{
    public function index(){
        return new SaladRecipesCollection(SaladRecipes::all());
    }

    public function show($id){
        //
    }

    public function store(StoreSaladRecipesRequest $request){
        try{
            $input = $request->all();
            $recipe = SaladRecipes::create([
                'name' => $input['name'],
                'description' => $input['description']
            ]);
            $recipe->fruits()->sync($input['fruits']);
            SaladRecipesServices::calculateNutrients($recipe);

            return response("Salad recipe was added successfully",201);
        }catch (\Exception $e){
            return response($e,400);
        }

    }

    public function update(StoreSaladRecipesRequest $request, $id){
        try{
            $input = $request->all();
            $recipe = SaladRecipes::find($id);
            $recipe->update([
                'name' => $input['name'],
                'description' => $input['description']
            ]);
            $recipe->fruits()->sync($input['fruits']);
            SaladRecipesServices::calculateNutrients($recipe);
            return response("Salad recipe was updated successfully",200);

        }catch (\Exception $e){
            return response($e,400);
        }
    }

    public function destroy($id){
        $saladRecipe = SaladRecipes::find($id);

        if($saladRecipe != null){
            $saladRecipe->fruits()->detach();
            $saladRecipe->delete();
            return response("Salad recipe ".$id." was deleted successfully", 200);
        }
        else{
            return response("Salad recipe ".$id." does not exist", 400);
        }
    }
}
