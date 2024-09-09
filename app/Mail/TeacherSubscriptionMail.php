<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TeacherSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;
    public $teacherName;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($teacherName, $password)
    {
        $this->teacherName = $teacherName;
        $this->password = $password;
    }
   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('Your NetbookFlix Account')
                    ->view('emails.teacher_subscription')
                    ->with([
                        'teacherName' => $this->teacherName,
                        'password' => $this->password,
                    ]);
    }
}
