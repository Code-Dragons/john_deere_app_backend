<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tractor extends Model
{

    protected $table = 'tractor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'model',
        'model_number',
        'description',
        'year_of_manufacture',
        'hours',
        'condition',
        'category',
        'horsepower',
        'drive',
        'picture'
    ];
    
    /**
     * The rules for data entry
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'model' => 'required',
        'model_number' => 'required',
        'description' => 'required',
        'year_of_manufacture' => 'required|numeric',
        'hours' => 'required|numeric',
        'condition' => 'required',
        'category' => 'required',
        'horsepower' => 'required|numeric',
        'drive' => 'required',
        'picture' => 'required'
    ];


    /**
     * Defines Foreign Key Relationship to the tractor model model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model()
    {
        return $this->belongsTo('App\Models\TractorModel');
    }

    /**
     * Defines Foreign Key Relationship to the tractor category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\TractorCategory');
    }

    /**
     * Defines Foreign Key Relationship to the category model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drive()
    {
        return $this->belongsTo('App\Models\Drive');
    }
}
