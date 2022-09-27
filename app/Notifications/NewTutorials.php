<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTutorials extends Notification implements ShouldQueue
{
    use Queueable;

    private $tutorialSlug;
    private $categorySlug;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tutorial)
    {
        $this->tutorialSlug = $tutorial->slug;
        $this->categorySlug = $tutorial->category->slug;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('New Tutorial has been added click the link below to view the new tutorial.')
                    ->action('Notification Action', route('tutorials.show.tutorial', ['category' => $this->categorySlug, 'tutorial' => $this->tutorialSlug]))
                    ->line('Thank you for using our application!');
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
            'New Tutorial has been added click the link below to view the new tutorial.'
        ];
    }
}
