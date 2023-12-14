<?php

namespace App\Http\Livewire\Stores;

use Livewire\Component;

class Edit extends Component
{
    public $store;

    public $email_settings = [
        'host' => '',
        'port' => '',
        'username' => '',
        'password' => '',
        'from_email_address' => '',
        'is_enabled' => '',
    ];

    protected $rules = [
        'email_settings.host' => 'sometimes',
        'email_settings.port' => 'sometimes',
        'email_settings.username' => 'sometimes',
        'email_settings.password' => 'sometimes',
        'email_settings.from_email_address' => 'email',
        'email_settings.is_enabled' => 'boolean',
    ];

    public function mount()
    {
        if ($this->store->emailSettings()) {
            foreach ($this->store->emailSettings() as $key => $value) {
                $this->email_settings[$key] = $value;
            }
        }
    }

    public function saveEmailSettings()
    {
        $this->store->email_settings = json_encode($this->email_settings);
        $this->store->saveQuietly();
    }

    public function render()
    {
        return view('livewire.stores.edit');
    }
}
