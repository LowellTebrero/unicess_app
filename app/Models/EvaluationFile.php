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

    protected $fillable = [
        'evaluation_id',
        'chairmanship_wide',
        'chairmanship_unit',
        'membership_wide',
        'membership_unit',
        'advisorships',
        'oics',
        'judges',
        'resource_generation',
        'chairmanship',
        'facilitation_ongoing',
        'facilitation_regional',
        'facilitation_national',
        'facilitation_international',
        'path',

    ];


    public function evaluation(){
        return $this->belongsTo(Evaluation::class);
    }
}
