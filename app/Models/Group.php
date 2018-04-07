<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Group extends Model
{

    protected $table = 'group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'tractor_ids',
    ];

    protected $casts = [
        'tractor_ids' => 'array',
    ];

    public static $rules = [
        'name' => 'required',
        'location' => 'required',
    ];


    /**
     * Defines Relationship to the user model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
