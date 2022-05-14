<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessarArquivoCSV implements ShouldQueue
{
    use InteractsWithQueue;

    public $delay = 30;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        if (config('app.env') == 'local') {
            $this->delay = 2;
        }
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        \Log::info("iniciando o evento");
        $importacao = new \App\Services\CSV\ImportacaoVendas;
        $importacao->processar($event->arquivoCSV);
        \Log::info("finalizando o evento");
    }
}
