<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class PasswordResetLinkMarkdown extends Mailable
{
    use Queueable, SerializesModels;
 
    public $user_name;
    public $link;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $link)
    {
        $this->user_name = $user_name;
        $this->link = $link;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Password Reset')->markdown('emails.password_reset_link_markdown');
    }
}