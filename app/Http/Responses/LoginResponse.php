<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $home = match (auth()->user()->role->name) {
            'partner' => '/dashboard',
            'administrator' => '/dashboard',
            default => '/'
        };

        return redirect()->intended($home);
    }
}
