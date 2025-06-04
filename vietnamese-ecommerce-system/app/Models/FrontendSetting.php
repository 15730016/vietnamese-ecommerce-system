<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontendSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'key',
        'value',
        'type',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    // Sections
    const SECTION_GENERAL = 'general';
    const SECTION_SIDEBAR = 'sidebar';
    const SECTION_SOCIAL = 'social';
    const SECTION_FOOTER = 'footer';
    const SECTION_CONTACT = 'contact';
    const SECTION_CUSTOM_CSS = 'custom_css';
    const SECTION_HTML_EMBED = 'html_embed';

    public static function getSetting($section, $key, $default = null)
    {
        $setting = static::where('section', $section)
            ->where('key', $key)
            ->first();

        return $setting ? $setting->value : $default;
    }

    public static function setSetting($section, $key, $value, $type = 'text')
    {
        return static::updateOrCreate(
            ['section' => $section, 'key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }

    public static function getGeneralSettings()
    {
        return static::where('section', self::SECTION_GENERAL)->get();
    }

    public static function getSidebarSettings()
    {
        return static::where('section', self::SECTION_SIDEBAR)->get();
    }

    public static function getSocialSettings()
    {
        return static::where('section', self::SECTION_SOCIAL)->get();
    }

    public static function getFooterSettings()
    {
        return static::where('section', self::SECTION_FOOTER)->get();
    }

    public static function getContactSettings()
    {
        return static::where('section', self::SECTION_CONTACT)->get();
    }

    public static function getCustomCss()
    {
        return static::getSetting(self::SECTION_CUSTOM_CSS, 'css', '');
    }

    public static function getHtmlEmbed()
    {
        return static::getSetting(self::SECTION_HTML_EMBED, 'html', '');
    }
}
