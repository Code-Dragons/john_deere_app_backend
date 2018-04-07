<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TractorModel extends Model
{
    protected $table = 'tractor_model';

    protected $fillable = ['name'];

    const JOHN_DEERE = 1;
    const MASSEY_FERGUSON = 2;
    const MAHINDRA = 3;
    const NEW_HOLLAND = 4;
}
