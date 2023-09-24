<?php

namespace  App\Services;

class SettingsService
{
    public function handleSettings(array $settings)
    {
        if($settings){
            $setting_array = [];
            foreach ($settings as $setting){
                if($setting){
                    $value = $setting->value;
                }
                $setting_array[$setting->key] = $value;
            }

            return $setting_array;
        }
        return false;
    }

}
