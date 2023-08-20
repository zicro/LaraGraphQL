<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // check login info, and create Token
        $user = User::where('email', $args['email'])->first();

        if(!$user || !Hash::check($args['password'], $user->password)){
            throw ValidationException::withMessages([
                'email' => "the credentials are invalid",
            ]);
        }
        return $user->createToken("web")->plainTextToken;
    }
}
