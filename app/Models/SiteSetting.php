<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
    ];

    /**
     * Get a site setting by key, with optional default value.
     */
    public static function get(string $key, ?string $default = null): ?string
    {
        try {
            if (!Schema::hasTable('site_settings')) {
                return $default;
            }
            $setting = self::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Set a site setting by key.
     */
    public static function set(string $key, ?string $value, string $group = 'general'): self
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }

    /**
     * Retrieve all settings as key-value array.
     */
    public static function allAsArray(): array
    {
        try {
            if (!Schema::hasTable('site_settings')) {
                return [];
            }
            return self::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }
}
