<?php

namespace App\Livewire\Forms;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class ClientForm extends Form
{
    use PasswordValidationRules;

    public ?User $user;

    public $first_name = '';

    public $last_name = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public $current_password = '';

    public $country_id = '';

    public $mobile = '';

    public $date_of_birth = '';

    public $language = '';

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->country_id = $user->country_id;
        $this->mobile = $user->mobile;
        $this->date_of_birth = $user->date_of_birth;
        $this->language = $user->language;
    }

    public function update($what)
    {
        switch ($what) {
            case 'profile':
                // Aggiorno i dati dell'utente
                $this->validate([
                    'first_name' => 'required|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->id,
                    'country_id' => 'nullable',
                    'mobile' => 'required',
                    'date_of_birth' => 'required|date|before:today',
                    'language' => 'required',
                ]);

                $this->user->update([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'email' => $this->email,
                    'country_id' => $this->country_id,
                    'mobile' => $this->mobile,
                    'date_of_birth' => $this->date_of_birth,
                    'language' => $this->language,
                ]);
                break;
            case 'security':
                $this->validate([
                    'current_password' => 'required',
                    'password' => 'min:8|confirmed',
                ]);
                if (! Hash::check($this->current_password, $this->user->password)) {
                    $this->addError('current_password', 'The current password is incorrect.');

                    return;
                }

                $this->user->update([
                    'password' => bcrypt($this->password),
                ]);
                break;
        }

        $this->component->dispatch('client-data-updated');
    }

    public function delete()
    {
        try {
            // TODO: Soft delete?
            (new \App\Actions\Jetstream\DeleteUser)->delete($this->user);

            return redirect()->route('guest.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
