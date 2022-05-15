<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacaoCSVProcessado;

class NotificarProcessamentoPorEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(public $arquivoCSV)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        foreach(\App\Models\User::all() as $user) {
            Mail::to($user)->send(new NotificacaoCSVProcessado($this->arquivoCSV));
        }
    }
}
