<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Faculty extends Model
{
    use HasFactory;


    protected $fillable = ['name'];


    public function user(){

        return $this->hasMany(User::class);

    }



    public function scopeSearch($query, $search)
    {
            $search = "%$search%";
    return  $query->where(function($query) use ($search){

            $query->where('first_name', 'like',   $search)
                ->orWhere('middle_name', 'like',   $search)
                ->orWhere('last_name', 'like',   $search)
                ->orWhere('gender', 'like',    $search)
                ->orWhere('email', 'like',   $search)
                ->orWhere('address', 'like',    $search)
                ->orWhere('authorize', 'like',     $search)
                ->orWhere('contact_number', 'like',   $search)
                ->orWhere('role', 'like',   $search);
        })

        ->orWhereHas('faculty', function($query) use ($search){
            $query->where('name', 'like',   $search);


       });

    //    $query->orWhereHas('faculty'($search) == 'Beneficiary/Partners', function($query) {
    //             $query->whereNull('faculty_id');
    //    });

    }
}
