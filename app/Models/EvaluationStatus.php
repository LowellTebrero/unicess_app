<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationStatus extends Model
{
    use HasFactory;

    protected $fillable = ['status'];
}
