<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FruitCollection;
use App\Models\Fruit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class FruitController extends Controller
{
    public function index(){
        $cached = Redis::get('Fruits');
        if(isset($cached)){
            $fruits = json_decode($cached, false);
            return response()->json($fruits);
        }
        else{
            $fruits = new FruitCollection(Fruit::all());
            Redis::set('Fruits',json_encode($fruits));
            return response()->json($fruits);
        }
    }

    public function store(){
        //
    }
}
