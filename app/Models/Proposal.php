<?php

namespace App\Models;

use App\Models\ProjectLike;
use App\Models\ProposalMember;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Proposal extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['started_date', 'finished_date'];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('proposalPdf');
        $this->addMediaCollection('specialOrderPdf');
        $this->addMediaCollection('travelOrder');
        $this->addMediaCollection('officeOrder');
        $this->addMediaCollection('otherFile');
        $this->addMediaCollection('MoaPDF');
    }

    public function programs():BelongsTo
    {
       return  $this->belongsTo(Program::class, 'program_id');
    }

    public function user():BelongsTo
    {
       return  $this->belongsTo(User::class );
    }

    // public function users(){
    //     return $this->belongsToMany(User::class, 'proposal_members', )->withPivot('created_at', 'proposal_id', 'leader_member_type' , 'member_type')->withTimestamps();
    // }


    public function proposal_members(){
        return $this->hasMany(ProposalMember::class );
    }


    public function medias()
    {
        return $this->hasMany(Media::class, 'model_id');
    }

    public function likes()
    {
        return $this->hasMany(ProjectLike::class);
    }


    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function AdminProgram()
    {
       return  $this->hasMany(AdminProgramServices::class, 'proposal_id');
    }

    public function scopeSearch($query, $search)
    {
        $search = "%$search%";

        return  $query->where(function($query) use ($search){

            $query->where('project_title', 'like',   $search)
            ->orWhere('proposals.authorize', 'like', $search)
            ->orWhere('proposals.status', 'like', $search);
            // ->orWhere('users.name', 'like', $search)
            // ->orWhere('users.first_name', 'like', $search)
            // ->orWhere('users.last_name', 'like', $search)
            // ->orWhere('users.email', 'like', $search)
            // ->orWhere('users.gender', 'like', $search)
            // ->orWhere('users.colleges', 'like', $search);

        })
        ->orWhereHas('proposal_members', function ($query) use ($search) {
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', $search)
                ->orWhere('colleges', 'like', $search)
                ->orWhere('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search)
                ->orWhere('email', 'like', $search)
                ->orWhere('gender', 'like', $search)
                ->orWhere('colleges', 'like', $search);
            });

        })
        ->orWhereHas('programs', function($query) use ($search){
            $query->where('program_name', 'like',   $search);
        })
        ->orWhereHas('user', function ($query) use ($search) {
            $query->whereHas('faculty', function ($query) use ($search) {
                $query->where('name', 'like', $search);
            });
        });

    }





}
