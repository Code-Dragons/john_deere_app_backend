<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TractorCategory extends Model
{
    protected $table = 'tractor_category';

    protected $fillable = ['name'];

    const UTILITY_TRACTOR = 1;
    const ROW_CROP_TRACTOR = 2;
    const ORCHARD_TRACTOR = 3;
    const INDUSTRIAL_TRACTOR = 4;
    const GARDEN_TRACTOR = 5;
    const ROTARY_TRACTOR = 6;
    const IMPLEMENT_CARRIER = 7;
    const EARTH_MOVING_TRACTOR = 8;
}
