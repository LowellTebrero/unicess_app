<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Faculty;
use App\Models\Proposal;
use App\Models\Evaluation;
use Illuminate\Support\Str;
use App\Models\ProposalMember;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */

     protected $table = 'users';

    protected $fillable = [
        'role',
        'faculty_id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'email',
        'address',
        'contact_number',
        'password',
        'provider',
        'provider_id',
        'google_access_token',
        'google_refresh_token',
        'authorize',
        'suffix',
        'province',
        'barangay',
        'zipcode',
        'birth_date',
        'city',
        'ip_address',
        'last_logged_in'


    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts(){

        return  $this->hasMany(Post::class);
     }

     public function getIsAdminAttribute()
     {
         return $this->roles()->where('id', 1)->exists();
     }

    public function faculty()
    {
       return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function partners()
    {
       return $this->belongsTo(Partner::class, 'partners_id');
    }

    public function proposal(){
        return $this->hasMany(Proposal::class);
    }

    public function proposalrequest(){
        return $this->hasMany(ProposalRequest::class);
    }

    public function evaluation(){
        return $this->hasMany(Evaluation::class);
    }

    public function proposals(){
        return $this->hasMany(ProposalMember::class );
    }

    public function temporary(){
        return $this->hasMany(TemporaryEvaluationFile::class );
    }



    public function role():BelongsToMany{
        return $this->belongsToMany(Role::class, 'model_has_roles' ,'model_id', 'role_id');
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
                ->orWhere('contact_number', 'like',   $search);
        })

        ->orWhereHas('faculty', function($query) use ($search){
            $query->where('name', 'like',   $search);


       });

    }







}
