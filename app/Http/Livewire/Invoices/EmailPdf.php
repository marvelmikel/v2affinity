<?php

namespace App\Http\Livewire\Invoices;

use App\Mail\InvoiceSent;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EmailPdf extends Component
{
    public $invoice, $store;
    public $sent = false;

    public function emailInvoice()
    {
        /* Overwrite Mail config to user the store settings if env is Prod */
        if (in_array(env('APP_ENV'), ['prod', 'production'])) {
            Config::set('mail.mailers.smtp.port', $this->store->emailSettings()->port);
            Config::set('mail.mailers.smtp.host', $this->store->emailSettings()->host);
            Config::set('mail.mailers.smtp.username', $this->store->emailSettings()->username);
            Config::set('mail.mailers.smtp.password', $this->store->emailSettings()->password);
            Config::set('mail.from.address', $this->store->emailSettings()->from_email_address);
        }

        /* Only allow user to send once per instance */
        if (!$this->sent) {
            $this->sent = true;
            Mail::send(new InvoiceSent($this->invoice));
        }
    }

    public function render()
    {
        return view('livewire.invoices.email-pdf');
    }
}
