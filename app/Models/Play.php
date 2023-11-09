<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use HasFactory;

    public $table = 'plays';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [

        'total',
        'pay',
        'date',
        'payment_form',
        'payment_method',
        'lottery_id'
    ];

    public function lotteryPlays()
    {
        return $this->hasMany(LotteryPlay::class);
    }

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }
}
