<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CreditStatus extends Model
{
    protected $table = 'credit_status';

    protected $fillable = ['name'];

    const GOOD = 1;
    const BAD = 2;
    const PENDING = 3;
}
