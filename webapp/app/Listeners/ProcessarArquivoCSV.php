<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ArquivoCSVProcessado;

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
        $importacao = new \App\Services\CSV\ImportacaoVendas;
        $importacao->processar($event->arquivoCSV);
        // event( new ArquivoCSVProcessado($event->arquivoCSV, $event->userId) );
        ArquivoCSVProcessado::dispatch($event->arquivoCSV, $event->userId);
    }
}
