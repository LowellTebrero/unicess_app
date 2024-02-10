<?php

namespace App\Models;

use App\Models\Location;
use Spatie\Tags\HasTags;
use App\Models\ProposalFiles;
use App\Models\ProposalMember;
use App\Models\TerminalReport;
use App\Models\UserAttendance;
use App\Models\NarrativeReport;
use App\Models\UserOfficeOrder;
use App\Models\UserTravelOrder;
use App\Models\UserSpecialOrder;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserAttendanceMonitoring;
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

    public function users(){
        return $this->belongsToMany(User::class, 'proposal_members', )->withPivot('created_at', 'proposal_id', 'leader_member_type' , 'member_type')->withTimestamps();
    }


    public function proposal_members(){
        return $this->hasMany(ProposalMember::class );
    }


    public function medias()
    {
        return $this->hasMany(Media::class, 'model_id');
    }



}


