<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'rank',
        'firstname',
        'lastname',
        'id_number',
        'soldier_number',
        'corps',
        'origin',
        'birthday',
        'rank_date',
        'education',
        'position_id',
    ];

    public function position() {
        return $this->belongsTo(Position::class);
    }
}
