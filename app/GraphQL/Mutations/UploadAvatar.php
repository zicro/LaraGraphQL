<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

final class UploadAvatar
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $file = $args['image'];
        $path = $file->storePublicly('public/uploads');
        $user = User::find($args['id']);
        $user->update(['avatar' => $path]);
        //$user->save();

        return $user;
    }
}
