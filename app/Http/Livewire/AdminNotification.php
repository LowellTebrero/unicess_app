<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Modal;

class AdminNotification extends Modal
{


    public function render()

    {
        return view('livewire.admin-notification',
        [
        'notifs'=> DB::table('notifications')->where('read_at', NULL)->count(),
        'notifications' => auth()->user()->unreadNotifications ]);




    }
}
