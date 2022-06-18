<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'shortname',
        'name',
        'expert',
        'rate',
        'corps',
        'status',
    ];

    public function employee() {
        return $this->hasOne(Employee::class);
    }
}
