<?php

namespace App\Observers;

use App\User;
use App\Notifications\Wellcome;
Use App\Models\Sjd\Email\EmailsSistema;

    class UserObserver
    {
        /**
         * Listen to the User created event.
         *
         * @param  User  $user
         * @return void
         */
        public function created(User $user)
        {
            // $user->notify(new Wellcome());

            // $dados = [
            //     'action' => 'Cadastrado no sistema',
            //     'identification' => $user->id,
            //     'subject' => $user->email
            // ];

            // EmailsSistema::create($dados);
        }

        /**
         * Listen to the User deleting event.
         *
         * @param  User  $user
         * @return void
         */
        public function deleting(User $user)
        {
            //
        }
    }