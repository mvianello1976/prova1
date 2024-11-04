<h1>Eliminazione disponibilità</h1>

<p>
    Hai eliminato la disponibilità dal <strong>{{ $availability_date->date_start->format('d-m-Y') }}</strong> al <strong>{{ $availability_date->date_end->format('d-m-Y') }}</strong> relativa all'attività <strong>"{{ $availability_date->availability->product->name }}"</strong>
</p>

<p>
    L'eliminazione della disponibilità ha escluso degli orari già acquistati da alcuni utenti,<br>
    si prega di avvisare i seguenti clienti:
</p>

<ul>
    @foreach($users as $user)
        <li>{{ $user }}</li>
    @endforeach
</ul>

Grazie,<br>
{{ config('app.name') }}
