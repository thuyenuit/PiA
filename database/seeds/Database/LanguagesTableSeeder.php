<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'lang_key' => 'da',
                'label' => 'Dansk',
                'flag' => 'dk',
                'is_primary' => false,
            ],
            [
                'lang_key' => 'en',
                'label' => 'English',
                'flag' => 'gb',
                'is_primary' => true,
            ],
        ];

        foreach ($languages as $language) {
            if (Language::where('lang_key', $language['lang_key'])->count() == 0) {
                echo "+ Adding to language code " . $language['lang_key'] . "\n";
                Language::create($language);
            }
        }
    }
}
