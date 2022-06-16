<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'shortname',
        'name',
        'number',
        'expert',
        'rate',
        'corps',
        'status',
        'employee_id',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
