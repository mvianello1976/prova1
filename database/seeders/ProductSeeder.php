<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::factory()->create([
            'name' => 'Tour a Venezia',
            'slug' => 'tour-a-venezia',
            'destination_id' => 1,
            'category_id' => 1,
            'typology_id' => 1,
            'current_step' => 13,
            'status' => 'published',
            'payment_type' => 'online',
        ]);
        $booking = Product::factory()->create([
            'name' => 'Noleggio gondola',
            'slug' => 'noleggio-gondola',
            'destination_id' => 1,
            'category_id' => 2,
            'typology_id' => 6,
            'current_step' => 13,
            'status' => 'published',
            'payment_type' => 'cash',
        ]);

        Storage::disk('public')->deleteDirectory('products');

        $images = glob(public_path('seeder/images/*'));
        foreach ($images as $image) {
            $path = Storage::disk('public')->put('products/'.$product->id.'/images', new File($image));
            $product->images()->create([
                'path' => $path,
            ]);
            $booking->images()->create([
                'path' => $path,
            ]);
        }

        // Reviews
        $product->reviews()->saveMany(Review::factory()->count(5)->make());
        $booking->reviews()->saveMany(Review::factory()->count(5)->make());

        // Faqs
        $product->faqs()->saveMany(Faq::factory()->count(5)->make());
        $booking->faqs()->saveMany(Faq::factory()->count(5)->make());
    }
}
