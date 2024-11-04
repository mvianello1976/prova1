<?php

namespace App\Livewire\Forms;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class UserForm extends Form
{
    use PasswordValidationRules;

    public ?User $user;

    public $first_name = '';

    public $last_name = '';

    public $email = '';

    public $password = '';

    public $password_confirmation = '';

    public $country_id = '';

    public $mobile = '';

    public $newsletter = false;

    public $marketing = false;

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->country_id = $user->country_id;
        $this->mobile = $user->mobile;
        $this->newsletter = $user->newsletter;
        $this->marketing = $user->marketing;
    }

    public function register($type)
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'country_id' => 'nullable',
            'mobile' => 'nullable',
            'password' => $this->passwordRules(),
            'newsletter' => 'sometimes',
            'marketing' => 'sometimes',
        ]);

        $user = User::create([
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'password' => bcrypt($this->password),
            'newsletter' => $this->newsletter,
            'marketing' => $this->marketing,
        ]);

        $user->assignRole($type);

        return Auth::attempt($this->only('email', 'password'));
    }

    public function update()
    {
        // Aggiorno i dati dell'utente
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user->id,
            'country_id' => 'nullable',
            'mobile' => 'required',
        ]);

        $user = User::updateOrCreate([
            'email' => $this->email,
        ], [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'country_id' => $this->country_id,
            'mobile' => $this->mobile,
        ]);

        $this->component->dispatch('client-data-updated');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string',
        ]);

        return Auth::attempt($this->only('email', 'password'));
    }
}
