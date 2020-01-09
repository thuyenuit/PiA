<?php

use Illuminate\Database\Seeder;
use App\Models\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configurations = [
            [
                'config_key' => config('constants.CONFIG_KEY.SITE_LOGO'),
                'config_value' => '',
            ],
            [
                'config_key' => config('constants.CONFIG_KEY.SITE_FAVICON'),
                'config_value' => '',
            ],
            [
                'config_key' => config('constants.CONFIG_KEY.LOGIN_IMAGE'),
                'config_value' => '',
            ],
            [
                'config_key' => config('constants.CONFIG_KEY.DEFAULT_AVATAR_IMAGE'),
                'config_value' => '',
            ],
        ];

        foreach ($configurations as $configuration) {
            if (Configuration::where('config_key', $configuration['config_key'])->count() == 0) {
                echo "+ Adding to configuration code " . $configuration['config_key'] . "\n";
                Configuration::create($configuration);
            }
        }
    }
}
