<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TractorCondition extends Model
{
    protected $table = 'tractor_condition';

    protected $fillable = ['name'];

    const BRAND_NEW = 1;
    const USED = 2;
}
