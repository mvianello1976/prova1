<?php

return [
    'languages' => [
        'it' => 'Italiano',
        'en' => 'Inglese',
        //        'de' => 'Tedesco',
        //        'fr' => 'Francese',
        //        'es' => 'Spagnolo',
    ],
    'partner' => [
        'onboarding' => [
            'partner_type' => [
                'company' => 'Azienda',
                'individual' => 'Individuo',
            ],
            'company_employees' => [
                '1-3' => '1 - 3',
                '4-10' => '4 - 10',
                '11-20' => '11 - 20',
                '21-50' => '21 - 50',
                '50+' => '50 +',
            ],
            'activities_provided' => [
                '1-2' => '1 - 2',
                '3-6' => '3 - 6',
                '7-15' => '7 - 15',
                '16-35' => '16 - 35',
                '35+' => '35 +',
            ],
            'activities_external_cms' => [
                'bookingkit' => 'Bookingkit',
            ],
        ],
        'payment_frequencies' => [
            'monthly' => '1 volta al mese',
        ],
        'commission_percentages' => [
            '10' => '10%',
        ],
    ],
    'reception_staff' => [
        'it' => 'Italiano',
        'en' => 'Inglese',
        'de' => 'Tedesco',
        'fr' => 'Francese',
        'es' => 'Spagnolo',
    ],
    'cancellations' => [
        'free' => [
            'label' => 'Cancellazione gratuita',
            'condition' => '',
        ],
        'soft' => [
            'label' => 'Soft',
            'condition' => '',
        ],
        'medium' => [
            'label' => 'Medium',
            'condition' => '',
        ],
        'hard' => [
            'label' => 'Hard',
            'condition' => '',
        ],
    ],
    'difficulties' => [
        'easy' => 'Facile',
        'medium' => 'Medio',
        'hard' => 'Difficile',
    ],
    'services' => [
        'price_per' => [
            'vehicle' => 'a mezzo',
            'person' => 'a persona',
            'unatantum' => 'una tantum'
        ],
        'food' => [
            'breakfast' => [
                'label' => 'Colazione',
            ],
            'lunch' => [
                'label' => 'Pranzo',
            ],
            'snack' => [
                'label' => 'Spuntino',
            ],
            'aperitif' => [
                'label' => 'Aperitivo',
            ],
            'dinner' => [
                'label' => 'Cena',
            ],
        ],
        'restrictions' => [
            'diabetic' => [
                'label' => 'Diabetico',
                'for' => 'diabetici',
            ],
            'vegetarian' => [
                'label' => 'Vegetariano',
                'for' => 'vegetariani',
            ],
            'gluten-free' => [
                'label' => 'Senza glutine',
                'for' => 'celiaci',
            ],
            'nut-free' => [
                'label' => 'Senza noci',
                'for' => 'nocio-allergici',
            ],
            'lactose-free' => [
                'label' => 'Senza lattosio',
                'for' => 'lattosio-intolleranti',
            ],
            'vegan' => [
                'label' => 'Vegano',
                'for' => 'vegani',
            ],
            'eggs-free' => [
                'label' => 'Senza uova',
                'for' => 'ovo-allergici',
            ],
        ],
        'staff' => [
            'skipper' => [
                'label' => 'Skipper',
                'description' => 'Personale competente che guiderà l\'imbarcazione',
            ],
            'tour-guide' => [
                'label' => 'Guida turistica',
                'description' => 'Descrizione guida turistica',
            ],
            'receptionist' => [
                'label' => 'Addetto al ricevimento',
                'description' => 'Descrizione addetto al ricevimento',
            ],
            'instructor' => [
                'label' => 'Istruttore',
                'description' => 'Descrizione istruttore',
            ],
            'driver' => [
                'label' => 'Autista',
            ],
        ],
        'transports' => [
            'bike' => [
                'label' => 'Bicicletta',
            ],
            'car' => [
                'label' => 'Auto',
            ],
            'motorcycle' => [
                'label' => 'Moto',
            ],
            'boat' => [
                'label' => 'Barca',
            ],
        ],
        'accessories' => [
            'diving_equipment' => [
                'label' => 'Attrezzatura da sub',
            ],
            'towel' => [
                'label' => 'Asciugamano',
            ],
        ],
        'languages' => [
            'it' => 'Italiano',
            'en' => 'Inglese',
            'de' => 'Tedesco',
            'fr' => 'Francese',
            'es' => 'Spagnolo',
        ],
    ],
    'product' => [
        'availabilities' => [
            'steps' => [
                '5',
                '10',
                '15',
                '20',
                '25',
                '30',
                '60',
            ],
        ],
        'booking_types' => [
            'direct' => [
                'label' => 'Acquisto diretto',
                'description' => 'La prenotazione non sarà da te modificabile, i clienti riceveranno in automatico un\'email di conferma',
            ],
            'confirmation' => [
                'label' => 'Previa conferma',
                'description' => 'Confermerai la prenotazione in base alle disponibilità',
            ],
        ],
        'payment_types' => [
            'cash' => [
                'label' => 'Contanti',
                'description' => 'Il cliente pagherà in contanti all\'arrivo',
            ],
            'online' => [
                'label' => 'Online',
                'description' => 'Il cliente pagherà online al momento del checkout',
            ],
        ],
        'statuses' => [
            'draft' => 'Bozza',
            'published' => 'Pubblicato',
        ],
    ],
    'order' => [
        'statuses' => [
            'approved' => 'Approvato',
            'to_approve' => 'Da approvare',
            'canceled' => 'Annullato',
        ],
        'payment_statuses' => [
            'paid' => 'Pagato',
            'unpaid' => 'Non pagato',
        ],
        'payment_methods' => [
            'cash' => 'Contanti',
            'online' => 'Online',
        ],
    ],
];
