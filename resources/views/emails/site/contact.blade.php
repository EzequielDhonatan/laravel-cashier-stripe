@component( 'mail::message' )
# Novo contato

Nome: {{ $data[ 'name' ] }}
E-mail: {{ $data[ 'email' ] }}
Assunto: {{ $data[ 'subject' ] }}
Mensagem: {{ $data[ 'message' ] }}

Obrigado,<br>

{{ config( 'app.name' -  }}

@endcomponent
