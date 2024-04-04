<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Proposal;

class CheckProposalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proposal:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update proposal statuses';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve all proposals
        $proposals = Proposal::all();

        foreach ($proposals as $proposal) {
            // Check if there exists a Terminal media record associated with the proposal and its creation date falls within the status_check_at period
            $terminalMediaExists = $proposal->media()
                ->where('created_at', '>', $proposal->created_at)
                ->where('created_at', '<=', $proposal->status_check_at)
                ->exists();

            // Set the proposal's status based on the existence of Terminal media records and their creation dates
            $proposal->status = $terminalMediaExists ? 'active' : 'inactive';
            $proposal->save();
        }

        $this->info('Proposal statuses checked and updated successfully.');

        return count($proposals);
    }
}
