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
    public function __construct()
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
        foreach(\App\Models\User::where('tipo','usuario')->get() as $user) {
            \Log::info("enviando arquivo para {$user->email}");
            Mail::to($user)->send(new NotificacaoCSVProcessado($event->arquivoCSV));
        }
    }
}
