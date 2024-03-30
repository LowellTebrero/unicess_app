<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProposalMember extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = ['proposal_id', 'user_id',];

    public function proposal(){
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($query, $search)
    {
        $search = "%$search%";

        return $query->where(function($query) use ($search) {
            $query->whereHas('user', function($userQuery) use ($search) {
                $userQuery->where('name', 'like', $search)
                          ->orWhere('first_name', 'like', $search)
                          ->orWhere('middle_name', 'like', $search)
                          ->orWhere('last_name', 'like', $search)
                          ->orWhere('gender', 'like', $search)
                          ->orWhere('email', 'like', $search)
                          ->orWhere('address', 'like', $search)
                          ->orWhere('authorize', 'like', $search)
                          ->orWhere('contact_number', 'like', $search)
                          ->orWhere('colleges', 'like', $search);
            });
        })
        ;
    }

}