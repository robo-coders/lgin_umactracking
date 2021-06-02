<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class approveTicketByRequestor extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ticket;
    protected $email;
    protected $db;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket,$email,$db)
    {
        $this->ticket = $ticket;
        $this->email = $email;
        $this->db = $db;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($this->email->status == '1' and $this->db->status == '0'){
            return ['mail'];
        }
        elseif($this->db->status == '1' and $this->email->status == '0'){
            return ['database'];
        }
        elseif($this->email->status == '1' and $this->db->status == '1' ){
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
                    ->line("Request# ".$this->ticket->request_id." has been appoved from your side.")
                    ->action('Labor Tracker', url('/'))
                    ->line('Thank you for your approval!');
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
            "data" => "Request# ".$this->ticket->request_id." has been appoved from your side."
        ];
    }
}
