<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaladRecipesRequest;
use App\Http\Resources\SaladRecipeDetailsResource;
use App\Http\Resources\SaladRecipesCollection;
use App\Http\Resources\SaladRecipesResource;
use App\Models\SaladRecipes;
use App\Services\SaladRecipesServices;
use http\Env\Response;
use Illuminate\Support\Facades\Redis;

class SaladController extends Controller
{
    public function index(){
        $cached = Redis::get('SaladRecipes');
        if(isset($cached)) {
            $recipes = json_decode($cached, false);
            return response()->json($recipes);
        }
        else{
            $recipes = new SaladRecipesCollection(SaladRecipes::all());
            Redis::set("SaladRecipes", json_encode($recipes));
            return response()->json($recipes);
        }
    }

    public function show($id){
        $cached = Redis::get('SaladRecipe_'.$id);
        if(isset($cached)) {
            $recipe = json_decode($cached, false);
            return response()->json($recipe);
        }
        else{
            $recipe = new SaladRecipeDetailsResource(SaladRecipes::find($id));
            Redis::set("SaladRecipe_".$id, json_encode($recipe));
            return response()->json($recipe);
        }

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
            $this->updateRedisValue($recipe->id,"create");

            return response(["message" => "Salad recipe was added successfully"],201);
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
            $this->updateRedisValue($id,"update");

            return response(["message" => "Salad recipe was updated successfully"],200);

        }catch (\Exception $e){
            return response($e,400);
        }
    }

    public function destroy($id){
        $saladRecipe = SaladRecipes::find($id);

        if($saladRecipe != null){
            $saladRecipe->fruits()->detach();
            $saladRecipe->delete();
            $this->updateRedisValue($id,"delete");
            return response(["message" => "Salad recipe ".$id." was deleted successfully"], 200);
        }
        else {
            return response(["message" => "Salad recipe ".$id." does not exist"], 400);
        }
    }

    public function updateRedisValue($id,$action)
    {
        if($action === "delete"){
            Redis::del("SaladRecipe_".$id);
        }
        else {
            Redis::set("SaladRecipe_".$id, json_encode(new SaladRecipeDetailsResource(SaladRecipes::find($id))));
        }
        Redis::set("SaladRecipes", json_encode(new SaladRecipesCollection(SaladRecipes::all())));
    }
}
