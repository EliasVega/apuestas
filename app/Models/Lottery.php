<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;

    public $table = 'lotteries';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'day'
    ];

    public function lotteryPlays()
    {
        return $this->hasMany(LotteryPlay::class);
    }

    public function plays()
    {
        return $this->hasMany(Play::class);
    }
}
