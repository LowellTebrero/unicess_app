<?php

namespace App\Observers;

use App\Models\Proposal;
use Illuminate\Support\Facades\Artisan;

class ProposalObserver
{
    /**
     * Handle the Proposal "created" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function created(Proposal $proposal)
    {
        Artisan::call('proposal:check-status');
         // Schedule a task to check the proposal status after 3 months
         $proposal->status_check_at = $proposal->created_at->addMonths(3);
         $proposal->save();
    }

    /**
     * Handle the Proposal "updated" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function updated(Proposal $proposal)
    {

        Artisan::call('proposal:check-status');

        if ($proposal->status_check_at < now()) {
            $proposal->status_check_at = now()->addMonths(3);
            $proposal->save();
        }


    }

    /**
     * Handle the Proposal "deleted" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function deleted(Proposal $proposal)
    {
        //
    }

    /**
     * Handle the Proposal "restored" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function restored(Proposal $proposal)
    {
        //
    }

    /**
     * Handle the Proposal "force deleted" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function forceDeleted(Proposal $proposal)
    {
        //
    }

    // protected function triggerCommand(Proposal $proposal)
    // {

    //     Artisan::call('proposal:check-status');

    // }
}
