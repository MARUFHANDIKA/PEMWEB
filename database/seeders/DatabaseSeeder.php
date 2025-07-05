<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'admin.com',
            'email' => 'admin@gmail.com',
            'phone' => '09887909878',
            'address' => 'Jawa',
            'gender' => 'male',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        // Categories
        $minuman = Category::create(['name' => 'Minuman']);
        $mieAyam = Category::create(['name' => 'Mie Ayam']);

        // Products
        $products = [
            [
                'name' => 'Es Jeruk',
                'description' => 'Segarkan harimu dengan Es Jeruk dari Pakde Joyo, UMKM kebanggaan Purbalingga! Terbuat dari perasan jeruk segar pilihan, disajikan dingin dengan es yang pas. Manis dan asamnya menyatu sempurna.',
                'price' => 5000,
                'category_id' => $minuman->id,
            ],
            [
                'name' => 'Es Teh',
                'description' => 'Dinginkan suasana dengan Es Teh segar dari Pakde Joyo! Perpaduan teh pilihan dan es dingin yang menyegarkan.',
                'price' => 4000,
                'category_id' => $minuman->id,
            ],
            [
                'name' => 'Mie Ayam Balungan',
                'description' => 'Mie telur kenyal dengan topping balungan berbumbu pedas manis yang empuk, menciptakan cita rasa unik.',
                'price' => 18000,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Mie Ayam Bakar Jumbo',
                'description' => 'Mie telur porsi jumbo dengan ayam bakar beraroma smoky dan rasa gurih manis khas Pakde Joyo.',
                'price' => 22000,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Mie Ayam Pangsit',
                'description' => 'Perpaduan mie kenyal, ayam gurih, dan pangsit goreng renyah, disajikan dengan kuah bening.',
                'price' => 17000,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Mie Ayam Bakar Paha Atas',
                'description' => 'Mie dengan ayam paha atas bakar dimarinasi dengan bumbu rahasia Pakde Joyo.',
                'price' => 20000,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Mie Ayam Bakar Paha Bawah',
                'description' => 'Mie kenyal dengan ayam paha bawah bakar beraroma khas dan tekstur padat gurih.',
                'price' => 19500,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Mie Ayam Rica Bakar',
                'description' => 'Ayam rica pedas + ayam bakar smoky dalam satu mangkuk mie gurih — kombinasi rasa terbaik!',
                'price' => 21000,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Mie Ayam Rica-Rica',
                'description' => 'Mie kenyal disajikan dengan ayam rica-rica pedas menggoda — cocok untuk pecinta pedas!',
                'price' => 19000,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Mie Bakso Rica',
                'description' => 'Mie ayam gurih berpadu bakso kecil dan rica pedas — pengalaman makan yang unik!',
                'price' => 20000,
                'category_id' => $mieAyam->id,
            ],
            [
                'name' => 'Bakso Pangsit Rica',
                'description' => 'Bakso kenyal, pangsit renyah, dan rica pedas tanpa mie — fokus ke rasa gurih & pedas!',
                'price' => 18000,
                'category_id' => $mieAyam->id,
            ]
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'image' => 'default.jpg', // default image placeholder
                'waiting_time' => 10,
                'view_count' => 0,
                'stock' => 100
            ]));
        }
    }
}
