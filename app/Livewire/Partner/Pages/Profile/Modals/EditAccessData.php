<?php

namespace App\Livewire\Partner\Pages\Profile\Modals;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class EditAccessData extends Component
{
    public $email;

    public $password;

    public $password_confirmation;

    public $current_password;

    public function mount()
    {
        $this->email = auth()->user()->email;
    }

    #[On('submit-profile-data')]
    public function submit()
    {
        $data = [];

        if ($this->email) {
            $this->validate([
                'email' => 'required|email|unique:users,email,'.auth()->id(),
            ]);
            auth()->user()->update([
                'email' => $this->email,
            ]);
        }
        if (!empty($this->password)) {
            $this->validate([
                'current_password' => 'required',
                'password' => 'min:8|confirmed',
            ]);

            if (!Hash::check($this->current_password, auth()->user()->password)) {
                $this->addError('current_password', 'The current password is incorrect.');

                return;
            }

            auth()->user()->update([
                'password' => bcrypt($this->password),
            ]);
        }

        $this->dispatch('partner-data-updated');
        $this->dispatch('close-slide-over');
    }

    public function render()
    {
        return view('livewire.partner.pages.profile.modals.edit-access-data');
    }

    protected function rules()
    {
        return [
            'partner_type' => ['required'],
            'company_name' => ['required'],
            'business_name' => ['required'],
            'vat_number' => ['required'],
            'head_office_address' => ['required'],
            'pec' => ['required'],
            'sdi' => ['nullable'],
            'company_link' => ['nullable'],
            'country_id' => ['required'],
            'currency' => ['required'],
            'contact_first_name' => ['nullable'],
            'contact_last_name' => ['nullable'],
        ];
    }
}
