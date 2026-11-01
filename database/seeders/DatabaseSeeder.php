<?php

namespace Database\Seeders;

use App\Models\Cafe;
use App\Models\Category;
use App\Models\Login;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Vult de database met testdata.
     * Draaien met: php artisan migrate:fresh --seed
     * Alle wachtwoorden zijn: password
     */
    public function run(): void
    {
        // ---- Users ----
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@cafesociety.nl',
            'role' => 'admin',
        ]);

        // Sanne heeft op 3 verschillende dagen ingelogd -> mag reviews plaatsen
        $sanne = User::factory()->create([
            'name' => 'Sanne',
            'email' => 'sanne@cafesociety.nl',
        ]);

        // Youssef is nieuw (1 dag ingelogd) -> mag nog GEEN review plaatsen
        $youssef = User::factory()->create([
            'name' => 'Youssef',
            'email' => 'youssef@cafesociety.nl',
        ]);

        // Kim is door de admin gedeactiveerd
        User::factory()->create([
            'name' => 'Kim',
            'email' => 'kim@cafesociety.nl',
            'is_active' => false,
        ]);

        // ---- Logins (om de "3 verschillende dagen"-regel te testen) ----
        Login::insert([
            ['user_id' => $sanne->id, 'created_at' => now()->subDays(6)->setTime(9, 12)],
            ['user_id' => $sanne->id, 'created_at' => now()->subDays(6)->setTime(17, 40)], // zelfde dag!
            ['user_id' => $sanne->id, 'created_at' => now()->subDays(4)->setTime(10, 5)],
            ['user_id' => $sanne->id, 'created_at' => now()->subDays(1)->setTime(14, 30)],
            ['user_id' => $youssef->id, 'created_at' => now()->subDays(1)->setTime(11, 0)],
            ['user_id' => $youssef->id, 'created_at' => now()->subDays(1)->setTime(15, 20)], // zelfde dag!
        ]);

        // ---- Categories ----
        $categories = collect(['Specialty coffee', 'Lunchroom', 'Werkplek', 'Terras'])
            ->mapWithKeys(fn ($name) => [$name => Category::create(['name' => $name])]);

        // ---- Cafes ----
        $cafes = collect([
            ['Bonjour Koffie', 'Rotterdam', 2, 'Specialty coffee'],
            ['Man Met Bril', 'Rotterdam', 2, 'Specialty coffee'],
            ['De Koffiekamer', 'Utrecht', 1, 'Lunchroom'],
            ['Studio Werkplek', 'Amsterdam', 3, 'Werkplek'],
            ['Het Zonnige Terras', 'Den Haag', 2, 'Terras'],
            ['Café Luxe', 'Amsterdam', 4, 'Lunchroom'],
        ])->map(fn ($c) => Cafe::create([
            'name' => $c[0],
            'city' => $c[1],
            'category_id' => $categories[$c[3]]->id,
        ]));

        // ---- Reviews (via de relatie, zodat user_id automatisch goed staat) ----
        $review1 = $sanne->reviews()->create([
            'cafe_id' => $cafes[0]->id,

            'body' => 'Beste flat white van Rotterdam. Rustig en snelle wifi.',
        ]);

        $review2 = $sanne->reviews()->create([
            'cafe_id' => $cafes[2]->id,

            'body' => 'Prima lunch, maar de koffie kan beter.',
        ]);

        $admin->reviews()->create([
            'cafe_id' => $cafes[3]->id,

            'body' => 'Fijne plek om te werken, genoeg stopcontacten.',
        ]);

        // ---- Comments ----
        $youssef->comments()->create([
            'review_id' => $review1->id,
            'body' => 'Ga ik zeker proberen!',
        ]);

        // ---- Likes (veel-op-veel: attach vult de tussentabel) ----
        $youssef->likedReviews()->attach([$review1->id, $review2->id]);
        $admin->likedReviews()->attach($review1->id);
    }
}
