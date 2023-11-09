<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProhibitedNumber extends Model
{
    use HasFactory;

    public $table = 'prohibited_numbers';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [

        'number'
    ];
}
