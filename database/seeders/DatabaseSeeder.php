<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with baseline admin and settings.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'hello@inoodex.com'],
            [
                'name' => 'Inoodex',
                'password' => bcrypt('hello@inoodex.com'),
            ]
        );

        $this->call([
            OurStorySeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}
