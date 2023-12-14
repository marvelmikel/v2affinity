<?php

namespace App\Mail;

use App\Models\Invoice;
use App\Models\Store;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class InvoiceSent extends Mailable
{
    use Queueable, SerializesModels;

    public Invoice $invoice;
    public $customer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->customer = $this->invoice->customer;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: $this->invoice->store->emailSettings()->from_email_address,
            to: $this->customer->email,
            subject: '[' . $this->invoice->store->store_name . ' - Invoice] ' . $this->invoice->customer->address_line_1,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $store = Store::find($this->invoice->store_id);
        if (!$store) {
            throw new \Exception('Store not found');
        }
    
        return (new Content(
            markdown: 'emails.invoice.sent'
        ))->with([
            'store' => $store,
            'store_logo' => $store->store_logo
        ]);
    }
    

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $pdf = PDF::loadView('voyager::invoices.pdf', [
            'invoice'   => $this->invoice,
            'customer'  => $this->invoice->customer,
            'user'      => auth()->user(),
            'count'     => $this->invoice->items->count(),
            'store'     => $this->invoice->store,
            'company'   => auth()->user()->company,
        ]);

        return [
            Attachment::fromData(fn () => $pdf->output(), '[' . $this->invoice->store->store_name . ' - Invoice] ' . $this->invoice->customer->address_line_1 . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
