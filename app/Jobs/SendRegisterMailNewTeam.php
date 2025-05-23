<?php

namespace App\Jobs;

use App\Mail\NewTeamUserRegistered;
use App\Models\TableMatch;
use App\Models\Teams;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRegisterMailNewTeam implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected string $email;
    protected string $password;
    protected Teams $team;

    public function __construct($email, $password, $team)
    {
        $this->email = $email;
        $this->password = $password;
        $this->team = $team;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info("init register in table matches", ['team_name' => $this->team]);
        TableMatch::create([
            'team_id' => $this->team->id,
            'matches' => 0,
            'wins' => 0,
            'losses' => 0,
            'draws' => 0,
            'points' => 0,
            'goals_for' => 0,
            'goal_difference' => 0,
            'goals_against' => 0,
            'category_id' => $this->team->category_id
        ]);
        Log::info("init process to send mail a new user");
        Mail::to($this->email)->send(new NewTeamUserRegistered($this->email, $this->password, $this->team->name));
        Log::info("send mail to {$this->email}");
    }
}
