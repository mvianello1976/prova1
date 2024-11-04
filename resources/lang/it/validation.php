<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Questo campo deve essere accettato.',
    'accepted_if' => 'Questo campo deve essere accettato quando :other è :value.',
    'active_url' => 'Questo campo non contiene un indirizzo email valido.',
    'after' => 'Questo campo deve essere successivo a :date.',
    'after_or_equal' => 'Questo campo deve essere successivo o uguale a :date.',
    'alpha' => 'Questo campo può contenere solamente lettere.',
    'alpha_dash' => 'Questo campo può contenere solamente lettere, numeri, trattini e trattini bassi.',
    'alpha_num' => 'Questo campo può contenere solamente lettere e numeri.',
    'array' => 'Questo campo deve essere un array.',
    'ascii' => 'Questo campo deve contenere solo caratteri alfanumerici e simboli a byte singolo.',
    'before' => 'Questo campo deve essere una data antecedente a :date.',
    'before_or_equal' => 'Questo campo deve essere una data antecedente o uguale a :date.',
    'between' => [
        'array' => 'Questo campo deve essere compreso tra :min and :max elementi.',
        'file' => 'Questo campo deve essere compreso tra :min e :max kilobytes.',
        'numeric' => 'Questo campo deve essere compreso tra :min e :max.',
        'string' => 'Questo campo deve essere compreso tra :min and :max caratteri.',
    ],
    'boolean' => 'Questo campo deve essere vero o falso.',
    'confirmed' => 'Questo campo non corrisponde.',
    'current_password' => 'La password inserita non è corretta.',
    'date' => 'Questo campo non è una data valida.',
    'date_equals' => 'Questo campo deve essere uguale a :date.',
    'date_format' => 'Questo campo non corrisponde al formato :format.',
    'decimal' => 'Questo campo deve avere :decimal decimali.',
    'declined' => 'Questo campo deve essere rifiutato.',
    'declined_if' => 'Questo campo deve essere rifiutato quando :other è :value.',
    'different' => 'Questo campo e :other devono essere diversi.',
    'digits' => 'Questo campo deve essere lungo :digits caratteri.',
    'digits_between' => 'Questo campo deve essere compreso tra :min e :max cifre.',
    'dimensions' => 'Le dimensioni immagine di Questo campo non sono valide.',
    'distinct' => 'Questo campo contiene dei valori duplicati.',
    'doesnt_end_with' => 'Questo campo non deve finire con uno dei seguenti valori: :values.',
    'doesnt_start_with' => 'Questo campo non deve cominciare con uno dei seguenti valori: :values.',
    'email' => 'Questo campo deve essere un indirizzo email valido.',
    'ends_with' => 'Questo campo deve finire con uno dei seguenti valori: :values.',
    'enum' => 'L\'elemento Questo campo selezionato non è valido.',
    'exists' => 'L\'elemento Questo campo selezionato non è valido.',
    'file' => 'Questo campo deve essere un file.',
    'filled' => 'Questo campo deve essere valorizzato.',
    'gt' => [
        'array' => 'Questo campo deve contenere più di :value elementi.',
        'file' => 'Questo campo deve essere più grande di :value kilobytes.',
        'numeric' => 'Questo campo deve essere maggiore di :value.',
        'string' => 'Questo campo deve contenere più di :value caratteri.',
    ],
    'gte' => [
        'array' => 'Questo campo deve contenere almeno :value elementi.',
        'file' => 'Questo campo deve essere maggiore o uguale a :value kilobytes.',
        'numeric' => 'Questo campo deve essere maggiore o uguale di :value.',
        'string' => 'Questo campo deve contenere almeno :value caratteri.',
    ],
    'image' => 'Questo campo deve essere un\'immagine.',
    'in' => 'Questo campo selezionato non è valido.',
    'in_array' => 'Questo campo non esiste in :other.',
    'integer' => 'Questo campo deve essere un intero.',
    'ip' => 'Questo campo deve essere un indirizzo IP valido.',
    'ipv4' => 'Questo campo deve essere un indirizzo IPv4 valido.',
    'ipv6' => 'Questo campo deve essere un indirizzo IPv6 valido.',
    'json' => 'Questo campo deve contenere una stringa JSON valida.',
    'lowercase' => 'Questo campo deve essere minuscolo.',
    'lt' => [
        'array' => 'Questo campo deve contenere meno di :value elementi.',
        'file' => 'Questo campo deve essere più piccolo di :value kilobytes.',
        'numeric' => 'Questo campo deve essere inferiore a :value.',
        'string' => 'Questo campo deve contenere meno di :value caratteri.',
    ],
    'lte' => [
        'array' => 'Questo campo deve contenere non più di :value elementi.',
        'file' => 'Questo campo deve essere minore o uguale a :value kilobytes.',
        'numeric' => 'Questo campo deve essere inferiore o uguale a :value.',
        'string' => 'Questo campo deve contenere non più di :value caratteri.',
    ],
    'mac_address' => 'Questo campo deve essere un indirizzo MAC valido.',
    'max' => [
        'array' => 'Questo campo non può contenere più di :max elementi.',
        'file' => 'Questo campo non può essere più grande di :max kilobytes.',
        'numeric' => 'Questo campo non può essere superiore a :max.',
        'string' => 'Questo campo non può essere più lungo di :max caratteri.',
    ],
    'max_digits' => 'Questo campo non deve contenere più di :max caratteri.',
    'mimes' => 'Questo campo deve contenere un file di tipo: :values.',
    'mimetypes' => 'Questo campo deve contenere un file di tipo: :values.',
    'min' => [
        'array' => 'Questo campo deve avere almeno :min elementi.',
        'file' => 'Questo campo deve essere almeno :min kilobyte.',
        'numeric' => 'Questo campo deve essere minimo :min.',
        'string' => 'Questo campo deve contenere almeno :min caratteri.',
    ],
    'min_digits' => 'Questo campo deve avere almeno :min caratteri.',
    'missing' => 'Questo campo deve essere mancante.',
    'missing_if' => 'Questo campo deve essere mancante se :other è :value.',
    'missing_unless' => 'Questo campo deve essere mancante a meno che :other non sia :value.',
    'missing_with' => 'Questo campo deve essere mancante quando :values è presente.',
    'missing_with_all' => 'Questo campo deve essere mancante quando :values sono presenti.',
    'multiple_of' => 'Questo campo deve essere un multiplo di :value.',
    'not_in' => 'Questo campo selezionato non è valido.',
    'not_regex' => 'Il formato di Questo campo non è valido.',
    'numeric' => 'Questo campo deve essere un numero.',
    'password' => [
        'letters' => 'Questo campo deve contenere almeno una lettera.',
        'mixed' => 'Questo campo deve contenere almeno una lettera maiuscola e una minuscola.',
        'numbers' => 'Questo campo deve contenere almeno un numero.',
        'symbols' => 'Questo campo deve contenere almeno un simbolo.',
        'uncompromised' => 'Questo campo compare in una fuga di dati. Scegli un altro Questo campo.',
    ],
    'present' => 'Questo campo deve essere presente.',
    'prohibited' => 'Questo campo è proibito.',
    'prohibited_if' => 'Questo campo è proibito quando :other è :value.',
    'prohibited_unless' => 'Questo campo è proibito a meno che :other non sia :values.',
    'prohibits' => 'Questo campo proibisce a :other di essere presente.',
    'regex' => 'Il formato di Questo campo non è valido.',
    'required' => 'Questo campo è richiesto.',
    'required_array_keys' => 'Questo campo deve contenere uno dei seguenti valori: :values.',
    'required_if' => 'Questo campo è richiesto quando :other è :value.',
    'required_if_accepted' => 'Questo campo è richiesto quando :other è accettato.',
    'required_unless' => 'Questo campo è richiesto salvo che :other sia in :values.',
    'required_with' => 'Questo campo è richiesto quando :values è presente.',
    'required_with_all' => 'Questo campo è richiesto quando sono presenti :values.',
    'required_without' => 'Questo campo è richiesto quando :values non è presente.',
    'required_without_all' => 'Questo campo è richiesto quanto nessuno di :values è presente.',
    'same' => 'Questo campo e :other devono corrispondere.',
    'size' => [
        'array' => 'Questo campo deve contenere :size elementi.',
        'file' => 'Questo campo deve essere :size kilobytes.',
        'numeric' => 'Questo campo deve essere :size.',
        'string' => 'Questo campo deve essere di :size caratteri.',
    ],
    'starts_with' => 'Questo campo deve cominciare con uno dei seguenti valori: :values.',
    'string' => 'Questo campo deve essere una stringa.',
    'timezone' => 'Questo campo deve essere un fuso orario valido.',
    'unique' => 'Questo campo è già in uso.',
    'uploaded' => 'L\'upload di Questo campo è fallito.',
    'uppercase' => 'Questo campo deve essere maiuscolo.',
    'url' => 'Questo campo deve essere un URL valido.',
    'ulid' => 'Questo campo deve essere un ULID valido.',
    'uuid' => 'Questo campo deve essere un UUID valido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
