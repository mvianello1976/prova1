<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Arte e Cultura',
            'Enogastronomia',
            'Escursioni con animali',
            'In Barca',
            'In Montagna',
            'Relax',
            'Adrenalina'
        ];
        foreach ($categories as $category) {
            Category::factory()->create([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => null
            ]);
        }
//        Category::factory()->create([
//            'name' => 'Categoria 1',
//            'slug' => 'categoria-1',
//            'description' => 'Descrizione della categoria 1'
//        ]);
//        $categories = Category::factory(10)->create();
    }
}
