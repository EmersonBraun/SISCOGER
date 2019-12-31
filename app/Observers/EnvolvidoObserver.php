<?php

namespace App\Observers;

use App\Models\Sjd\Policiais\Envolvido;
use App\Repositories\administracao\UserRepository;
use App\Services\BlockUserService;

    class EnvolvidoObserver
    {
        protected $user;
        protected $block;
        public function __construct(
            UserRepository $user,
            BlockUserService $block
        )
        {
            $this->user = $user;
            $this->block = $block;
        }
        /**
         * Listen to the Envolvido created event.
         *
         * @param  Envolvido  $envolvido
         * @return void
         */
        public function created(Envolvido $envolvido)
        {
            $envolvido_is_user = $this->user->getRg($envolvido['rg']);
            if(
                $envolvido['id_cd'] || $envolvido['id_cd'] || $envolvido['id_cd']
                && $envolvido_is_user 
                && $envolvido['situacao'] == 'Acusado'
            )
            $block = $this->block($envolvido_is_user['id'],"Acusado em CD, CJ ou ADL");
        }

        /**
         * Listen to the Envolvido deleting event.
         *
         * @param  Envolvido  $envolvido
         * @return void
         */
        public function deleting(Envolvido $envolvido)
        {
            //
        }
    }