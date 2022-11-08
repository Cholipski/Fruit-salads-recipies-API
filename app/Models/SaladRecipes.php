<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaladRecipes extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];

    public function fruits()
    {
        return $this->belongsToMany(Fruit::class,'salad_fruits',
            "recipe_id","fruit_id")->withPivot(['weight']);
    }
}
