<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Drive extends Model
{
    protected $table = 'drive';

    protected $fillable = ['name'];

    const TWO_WHEEL_DRIVE = 1;
    const FOUR_WHEEL_DRIVE = 2;
    const MECHANICAL_FRONT_WHEEL_DRIVE = 3;
    const HYDRAULIC_FRONT_WHEEL_DRIVE = 4;
}
