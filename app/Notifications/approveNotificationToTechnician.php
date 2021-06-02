<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Auth;
use App\ticket;
use App\review;
use App\history;
use App\db_notification;
use App\email_notification;

class approveNotificationToTechnician extends Notification implements ShouldQueue
{
    use Queueable;
    protected $ticket;
    protected $technician_email;
    protected $technician_db;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticket,$technician_email,$technician_db)
    {
        $this->ticket = $ticket;
        $this->technician_email = $technician_email;
        $this->technician_db = $technician_db;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if($this->technician_email->status == '1' and $this->technician_db->status == '0'){
            return ['mail'];
        }
        elseif($this->technician_db->status == '1' and $this->technician_email->status == '0'){
            return ['database'];
        }
        elseif($this->technician_email->status == '1' and $this->technician_db->status == '1' ){
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
                    ->line("Request# ".$this->ticket->request_id." has been approved by a Requestor.")
                    ->action('Labor Tracker', url('/'))
                    ->line('Thank you for great Fixing!');
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
                "data" => "Request# ".$this->ticket->request_id." has been approved by a Requestor.",
            ];
    }
}
