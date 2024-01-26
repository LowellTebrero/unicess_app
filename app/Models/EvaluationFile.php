<?php

namespace App\Models;

use App\Models\Evaluation;
use Illuminate\Database\Eloquent\Model;
use RahulHaque\Filepond\Traits\HasFilepond;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationFile extends Model
{
    use HasFactory;
    use HasFilepond;

    protected $guarded = [];


    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
    }
}
