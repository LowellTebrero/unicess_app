<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryEvaluationFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chairmanship_wide',
        'chairmanship_wide_file',
        'chairmanship_unit',
        'chairmanship_unit_file',
        'membership_wide',
        'membership_wide_file',
        'membership_unit',
        'membership_unit_file',
        'advisorships',
        'advisorships_file',
        'oics',
        'oics_file',
        'judges',
        'judges_file',
        'resource_generation',
        'resource_generation_file',
        'chairmanship',
        'chairmanship_file',
        'facilitation_ongoing',
        'facilitation_ongoing_file',
        'facilitation_regional',
        'facilitation_regional_file',
        'facilitation_national',
        'facilitation_national_file',
        'facilitation_international',
        'facilitation_international_file',
    ];



    public function user(){
        return $this->belongsTo(User::class );
    }
}
