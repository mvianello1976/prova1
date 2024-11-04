<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Typology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typologies = [
            'Biglietto di attrazione' => 'Come l\'ingresso di un punto di riferimento, in un parco a tema, in uno spettacolo',
            'Tour' => 'Come un tour guidato a piedi, una gita di un giorno, una crociera in città',
            'City Card' => 'Un pass per più attrazioni o trasporti all\'interno di una città',
            'Biglietto hop-on hop-off' => 'Ingresso su un autobus o in una barca hop-on hop-off',
            'Trasferimento' => 'Servizi di trasporto come trasferimento aeroportuali o in autobus',
            'Noleggio' => 'Come i mezzi di trasporto, le attrezzature sportive, i router Wi-Fi',
        ];
        foreach ($typologies as $typology => $description) {
            Typology::factory()->create([
                'name' => $typology,
                'slug' => Str::slug($typology),
                'description' => $description
            ]);
        }

//        Typology::factory()->create([
//            'name' => 'Tipologia 1',
//            'slug' => 'tipologia-1',
//            'description' => 'Descrizione della tipologia 1'
//        ]);
//        $typologies = Typology::factory(10)->create();
    }
}
