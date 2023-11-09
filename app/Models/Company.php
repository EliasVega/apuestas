<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $table = 'companies';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        //
        'name',
        'code',
        'nit',
        'dv',
        'address',
        'phone',
        'email',
        'imageName',
        'logo',
        'status',
        'department_id',
        'municipaliy_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
    public function indicator(){
        return $this->hasOne(Indicator::class);
    }
}
