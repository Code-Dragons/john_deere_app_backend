<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'national_id',
        'phone_number',
        'group_id',
        'credit_status_id',
        'password',
        'remember_token'
    ];

    public static $rules = [
        'name' => 'required',
        'national_id' => 'required|numeric|unique',
        'phone_number' => 'required|numeric|unique',
        'group_id' => 'numeric',
        'credit_status_id' => 'numeric',
        'password' => 'required',
        'remember_token' => 'required'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Defines Foreign Key Relationship to the group model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group');
    }

    /**
     * Defines Foreign Key Relationship to the credit status model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creditStatus()
    {
        return $this->belongsTo('App\Models\Status');
    }

    /**
     * Returns the user's contribution to date
     *
     * @return int
     */
    public function getUserContributionToDateAttribute()
    {
        return Contribution::select('amount')
                            ->where('user_id', $this->attributes['id'])
                            ->sum();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
