<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Inoodex',
            'email' => 'hello@inoodex.com',
            'password' => bcrypt('hello@inoodex.com'),
        ]);

        $this->call([
            ProductSeeder::class,
            OurStorySeeder::class,
            SiteSettingSeeder::class,
            HeroSlideSeeder::class,
        ]);
    }
}
