<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['template_name' ];



    public function programs():BelongsTo
    {

       return  $this->belongsTo(Program::class, 'program_id');
    }

   public function users():BelongsTo
    {
       return  $this->belongsTo(User::class, 'user_id');
    }

    public function faculty()
    {
       return $this->belongsTo(Faculty::class, 'faculty_id');
    }

}
