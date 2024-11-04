<h1>Reminder: Approva la prenotazione</h1>

<p>
    Hai un'attività che necessita di essere approvata. È previsto che questa attività inizi tra meno di 12 ore.
</p>

<p>
    Dettagli:
</p>

<ul>
    <li>Ordine: {{ $order->uuid }}</li>
    <li>Attività: {{ $order->data['product']['name'] }}</li>
    <li>Inizio attività: {{ \Carbon\Carbon::parse($order->data['booking']['date'])->format('d/m/Y') }} alle {{ \Carbon\Carbon::parse($order->data['booking']['time'])->format('H:i') }}</li>
</ul>

<a href="{{ route('bookings.management.show', $order->id) }}">Approva subito</a>

Grazie,<br>
{{ config('app.name') }}
