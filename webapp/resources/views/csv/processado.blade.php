@component('mail::message')
# Processamento de arquivos
 
Ei, o arquivo {{$arquivo}} acaba de ser processado com sucesso!

Você poderá consultar o histórico para saber quantos registros foram importados.
 
Até logo,<br>
{{ config('app.name') }}
@endcomponent