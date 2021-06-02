<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class closeTicketByTechnician extends Notification implements shouldQueue
{
    use Queueable;
    protected $ticket;
    protected $requestor_email;
    protected $requestor_db;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket,$requestor_email,$requestor_db)
    {
        $this->ticket = $ticket;
        $this->requestor_email = $requestor_email;
        $this->requestor_db = $requestor_db;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($this->requestor_email->status == '1' and $this->requestor_db->status == '0'){
            return ['mail'];
        }
        elseif($this->requestor_db->status == '1' and $this->requestor_email->status == '0'){
            return ['database'];
        }
        elseif($this->requestor_email->status == '1' and $this->requestor_db->status == '1' ){
            return ['mail','database'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Your Request# ".$this->ticket->request_id." has been fixed by ".$this->ticket->technician->name)
                    ->action('Labor Tracker', url('/'))
                    ->line('Thank you for keeping patience!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "data" => "Your Request# ".$this->ticket->request_id." has been fixed by ".$this->ticket->technician->name,
        ];
    }
}
