<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class LanguageLinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = config('constants.LOCALE_TABS');
        array_push($groups, 'app');

        foreach ($groups as $group) {
            $dbKeys = LanguageLine::where('group', $group)->pluck('key')->toArray();
            $fileKeys = CommonHelper::arrayKeysFlatten(__($group), '');
            foreach ($dbKeys as $dbKey) {
                if (!in_array($dbKey, $fileKeys)) {
                    echo "- Deleting from $group with key $dbKey\n";
                    LanguageLine::where('group', $group)->where('key', $dbKey)->delete();
                }
            }
            foreach ($fileKeys as $fileKey) {
                if (!in_array($fileKey, $dbKeys)) {
                    echo "+ Adding to group $group with key $fileKey\n";
                    LanguageLine::create([
                        'group' => $group,
                        'key' => $fileKey,
                        'text' => [
                            'en' => __("$group.$fileKey"),
                        ],
                    ]);
                }
            }
        }
    }
}
