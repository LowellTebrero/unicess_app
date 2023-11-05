<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Http\Livewire\Modal;


class PendingUser extends Modal
{

    public function render()
    {
        return view('livewire.pending-user',['pendingAccount'=> User::where('authorize', 'pending')->get()]);
    }
}
