<?php

namespace App\Mail;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionCancelled extends Mailable
{
    use Queueable, SerializesModels;

    public $plan;
    public $subscription;

    /**
     * Create a new message instance.
     */
    public function __construct(Subscription $subscription)
    {
        // Load local properties
        $this->subscription = $subscription;
        $this->plan = Plan::where('id',$subscription->plan_id)->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: env('APP_NAME').' Subscription Cancelled',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.subscription-cancelled',
            with: [
                'plan' => $this->plan,
                'subscription' => $this->subscription
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
