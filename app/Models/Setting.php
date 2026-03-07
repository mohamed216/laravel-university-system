<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        return match ($setting->type) {
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $setting->value,
            'array' => is_array($setting->value) ? $setting->value : json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    public static function set($key, $value, $type = 'string', $group = 'general', $description = null)
    {
        $type = gettype($value) === 'array' ? 'array' : $type;
        
        if (is_array($value)) {
            $value = json_encode($value);
        }

        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
                'description' => $description,
            ]
        );
    }

    public static function getByGroup($group)
    {
        return static::where('group', $group)->get()->pluck('value', 'key');
    }

    public static function allGrouped()
    {
        return static::all()->groupBy('group');
    }

    public static function getUniversityName()
    {
        return static::get('university_name', 'University System');
    }

    public static function getUniversityLogo()
    {
        return static::get('university_logo');
    }

    public static function getContactInfo()
    {
        return [
            'email' => static::get('contact_email', 'info@university.edu'),
            'phone' => static::get('contact_phone', '+1 234 567 8900'),
            'address' => static::get('contact_address', '123 University Ave'),
            'city' => static::get('contact_city', 'University City'),
        ];
    }

    public static function initializeDefaults()
    {
        $defaults = [
            'university_name' => ['value' => 'University System', 'type' => 'string', 'group' => 'general', 'description' => 'University Name'],
            'university_logo' => ['value' => '', 'type' => 'string', 'group' => 'general', 'description' => 'University Logo URL'],
            'contact_email' => ['value' => 'info@university.edu', 'type' => 'string', 'group' => 'contact', 'description' => 'Contact Email'],
            'contact_phone' => ['value' => '+1 234 567 8900', 'type' => 'string', 'group' => 'contact', 'description' => 'Contact Phone'],
            'contact_address' => ['value' => '123 University Ave', 'type' => 'string', 'group' => 'contact', 'description' => 'Contact Address'],
            'contact_city' => ['value' => 'University City', 'type' => 'string', 'group' => 'contact', 'description' => 'City'],
            'academic_year' => ['value' => date('Y'), 'type' => 'integer', 'group' => 'academic', 'description' => 'Current Academic Year'],
            'semester_start' => ['value' => '2026-01-01', 'type' => 'string', 'group' => 'academic', 'description' => 'Semester Start Date'],
            'semester_end' => ['value' => '2026-06-30', 'type' => 'string', 'group' => 'academic', 'description' => 'Semester End Date'],
            'registration_open' => ['value' => 'true', 'type' => 'boolean', 'group' => 'academic', 'description' => 'Registration Open'],
            'currency_symbol' => ['value' => '$', 'type' => 'string', 'group' => 'finance', 'description' => 'Currency Symbol'],
            'late_fee_percentage' => ['value' => '5', 'type' => 'integer', 'group' => 'finance', 'description' => 'Late Fee Percentage'],
        ];

        foreach ($defaults as $key => $config) {
            static::set($key, $config['value'], $config['type'], $config['group'], $config['description']);
        }
    }
}
