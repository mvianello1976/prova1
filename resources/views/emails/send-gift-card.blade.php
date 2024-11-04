<h1>Gift Card Ricevuta</h1>

<p>Hai ricevuto una Gift Card da parte di <strong>{{ $gift_card_user->sender->fullname }}</strong><p>

<p>Riscattala entro il {{ $gift_card_user->activation_deadline->format('d/m/Y') }}</p>

<p>Ecco il codice di riscatto: <strong>{{ $gift_card_user->redeem_code }}</strong></p>

Grazie,<br>
{{ config('app.name') }}
