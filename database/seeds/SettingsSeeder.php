<?php


use Tungltdev\LaravelSettings\Facades\Settings;

class SettingsSeeder extends DatabaseSeeder
{

    public function run()
    {
        Settings::set('site_name', "CRM");
        Settings::set('site_email', 'admin@crm.com');
        Settings::set('allowed_extensions', 'gif,jpg,jpeg,png,pdf,txt');
        Settings::set('max_upload_file_size', 10000);
        Settings::set('backup_type', 'local');
        Settings::set('email_driver', 'smtp');
        Settings::set('minimum_characters', 3);
        Settings::set('date_format', 'd/m/Y');
        Settings::set('jquery_date', 'DD/MM/YYYY');
        Settings::set('time_format', 'H:i');
        Settings::set('jquery_date_time', 'DD/MM/YYYY HH:mm');
        Settings::set('tracking_number', 1);

    }

}
