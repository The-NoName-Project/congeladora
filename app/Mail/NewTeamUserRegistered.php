<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewTeamUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    protected string $email;
    protected string $password;
    protected mixed $team;

    /**
     * Create a new message instance.
     */

    public function __construct($email, $password, $team)
    {
        $this->email = $email;
        $this->password = $password;
        $this->team = $team;
    }

    public function build()
    {
        return $this->subject(__('New Team'))
                    ->view('emails.new-team-user')
                    ->with(['email' => $this->email, 'password' => $this->password, 'team_name' => $this->team]);
    }

//    /**
//     * Get the message envelope.
//     */
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'New Team User Registered',
//        );
//    }
//
//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'view.name',
//        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }
}
