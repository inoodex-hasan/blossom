<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Sundry Blossom',
            'site_tagline' => 'Handcrafted & Sustainable Goods',
            'contact_phone' => '+880 4767 775689',
            'contact_phone_display' => '04767775689',
            'contact_email' => 'sundryblossom@gmail.com',
            'contact_hours' => 'Mon - Fri, 9am - 6pm',
            'contact_response_time' => 'We reply within 24 hours',
            'contact_address' => 'Dhaka, Bangladesh',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}
