<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectDownNotification extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Build the message.
     *
     * @return $this
     */
public function build()
    {
        return $this->from('sava.bezanovic@quantox.com', 'Website Health Checker')
            ->subject('Project Down Notification')
            ->markdown('mails.project-down-notification')
            ->with([
                'name' => 'Project Team Member',
                'link' => 'https://mailtrap.io/inboxes'
            ]);
    }
}