<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WhatsApp\Component;
use NotificationChannels\WhatsApp\WhatsAppChannel;
use NotificationChannels\WhatsApp\WhatsAppTemplate;

class MemberInvitation extends Notification
{
    use Queueable;
    public $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = [
            'phone_number' => $data['phone_number'],
            'member_name' => $data['member_name'],
            'day_name' => $data['day_name'],
            'day_month_year' => $data['day_month_year'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'place' => $data['place'],
            'event_name' => $data['event_name'],
            'notes' => $data['notes'],
            'btn_link' => $data['btn_link']
        ];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsAppChannel::class];;
    }

    public function toWhatsapp($notifiable)
    {
        return WhatsAppTemplate::create($this->data['phone_number'],'Karisma','id')
            ->name('invitation')
            ->body(Component::text($this->data['member_name'])) // member_name
            ->body(Component::text($this->data['day_name'])) // day_name
            ->body(Component::text($this->data['day_month_year'])) // day_month_year
            ->body(Component::text($this->data['start_date'])) // start_date
            ->body(Component::text($this->data['end_date'])) // end_date
            ->body(Component::text($this->data['place'])) // place
            ->body(Component::text($this->data['event_name'])) // event_name
            ->body(Component::text($this->data['notes'])) // notes
            ->buttons(Component::urlButton([$this->data['btn_link']]))
            ->to($this->data['phone_number']);
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

        ];
    }
}
