<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    use HasFactory;

    public $table = 'cash_registers';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'cash_initial',
        'in_cash',
        'out_cash',
        'in_total',
        'out_total',
        'cash_in_total',
        'cash_out_total',
        'value_play_total',
        'nequi',
        'credito',
        'status',
        'user_id',

    ];

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cashInflows(){
        return $this->belongsTo(CashInflow::class);
    }

    public function cashOutflows(){
        return $this->hasMany(CashOutflow::class);
    }
}
