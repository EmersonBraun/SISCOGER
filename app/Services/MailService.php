<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use Illuminate\Support\Facades\Mail;

use App\Mail\wellcomeUser;
use App\Models\Sjd\Email\EmailsSistema;

class MailService 
{
    protected $emailsistema;

	public function __construct(EmailsSistema $emailsistema)
	{
        $this->emailsistema = $emailsistema;
    }

    public function wellcome($user, $type)
    {
        $sent = Mail::to($user->email)->send(new wellcomeUser($user));
        if (count(Mail::failures()) > 0) { 
            $fail = Mail::failures();
            return $fail;
        } else {
            $this->saveEmailSistema($user, $type);
            return 'ok';
        }

    }

    public function saveEmailSistema($user, $type)
    {
        $action = ($type == 'send') ? 'Cadastrado no sistema' : 'Reenvio';
        $dados = [
            'action' => $action,
            'identification' => $user->id,
            'subject' => $user->email
        ];

        EmailsSistema::create($dados);
    }
 
}

