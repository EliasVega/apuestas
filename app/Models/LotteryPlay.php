<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryPlay extends Model
{
    use HasFactory;
    public $table = 'lottery_plays';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [

        'type',
        'number',
        'value',

        'lottery_id',
        'play_id'
    ];

    public function lottery()
    {
        return $this->belongsTo(Lottery::class);
    }

    public function play()
    {
        return $this->belongsTo(Play::class);
    }
}
