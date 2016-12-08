<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPass extends Mailable
{
    use Queueable, SerializesModels;
    private $username;
    private $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Thông tin tài khoản tại ThesisMgr";
        return $this->view('mail.userpass')
            ->subject($subject)
            ->with('username', $this->username)
            ->with('password', $this->password);
    }
}
