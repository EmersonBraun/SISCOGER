<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
class wellcomeUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        // $this
        // $this->to = $user->email;
        // $this->subject = 'Boas Vindas - SISCOGER';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->view('email.wellcome')
                ->subject('Boas Vindas - SISCOGER')
                ->with(['user' => $this->user]);
    }
}
