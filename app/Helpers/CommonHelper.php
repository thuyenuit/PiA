<?php

namespace App\Helpers;

use Illuminate\Support\Arr;
use Spatie\TranslationLoader\LanguageLine;

class CommonHelper
{
    /**
     * Format date to short date (day month year)
     *
     * @param $date
     * @return string
     */
    public static function formatShortDate($date): string
    {
        if (empty($date)) {
            return '';
        }
        return date('d-m-Y', strtotime($date));
    }

    /**
     * Format date to long date (day month year hour minute second)
     *
     * @param $date
     * @return string
     */
    public static function formatLongDate($date): string
    {
        if (empty($date)) {
            return '';
        }
        return date('d-m-Y H:i:s', strtotime($date));
    }

    /**
     * Format number to integer with thousands separate symbol
     *
     * @param $number
     * @return string
     */
    public static function formatInteger($number): string
    {
        if (empty($number)) {
            return '';
        }

        if (!is_numeric($number)) {
            return '';
        }

        if ($number < 0) {
            return '';
        }
        return number_format($number, 0, ',', '.');
    }

    /**
     * Correct keyword for searching text
     *
     * @param $keyword
     * @return string
     */
    public static function correctSearchKeyword($keyword): string
    {
        $keyword = str_replace(' ', '%', $keyword);
        return "%$keyword%";
    }

    /**
     * Generate show button for datatables
     *
     * @param $url
     * @return string
     */
    public static function generateButtonShow($url): string
    {
        return "<a href='$url' class='btn btn-circle btn-primary ml-1'><i class='fas fa-eye'></i></a>";
    }

    /**
     * Generate edit button for datatables
     *
     * @param $url
     * @return string
     */
    public static function generateButtonEdit($url): string
    {
        return "<a href='$url' class='btn btn-circle btn-info ml-1'><i class='fas fa-pencil-alt'></i></a>";
    }

    /**
     * Generate delete button for datatables
     *
     * @param $url
     * @return string
     */
    public static function generateButtonDelete($url): string
    {
        $methodField = "<input type='hidden' name='_method' value='DELETE'>";
        $button = "<a class='btn btn-circle btn-danger' onclick='confirmDelete(event, this)'><i class='fas fa-trash-alt'></i></a>";
        return "<form method='POST' action='$url' class='ml-1'>" . csrf_field() . $methodField . $button . "</form>";
    }

    /**
     * Flatten keys of translation data
     *
     * @param $url
     * @return string
     */
    public static function arrayKeysFlatten($array, $prefix): array
    {
        $newKeys = [];
        foreach (array_keys($array) as $key) {
            if (empty($prefix)) {
                $newKey = $key;
            } else {
                $newKey = "$prefix.$key";
            }
            if (is_array($array[$key])) {
                $subKeys = CommonHelper::arrayKeysFlatten($array[$key], $newKey);
                $newKeys = array_merge($newKeys, $subKeys);
            } else {
                array_push($newKeys, $newKey);
            }
        }
        return $newKeys;
    }

    /**
     * Get translation from database only
     *
     * @param $group
     * @param $key
     * @param $locale
     * @return string|null
     */
    public static function getTranslation($group, $key, $locale): ?string
    {
        $rows = LanguageLine::where('group', $group)->where('key', $key)->pluck("text->$locale as text")->toArray();
        if (count($rows) > 0) {
            return $rows[0];
        }
        return null;
    }

    /**
     * Get flag code from language code
     *
     * @param $languages
     * @param $code
     * @return string|null
     */
    public static function getLocaleFlag($languages, $code): ?string
    {
        $language = Arr::first($languages, function ($value) use ($code) {
            return $value->lang_key == $code;
        });
        return empty($language) ? null : $language->flag;
    }
}
