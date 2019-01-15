<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use DB;
use Illuminate\Http\Request;

class SettingsController extends UserController
{
    public function __construct()
    {
        parent::__construct();

        view()->share('type', 'setting');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracking_number = unserialize(DB::table('settings')->where('setting_key',
            'tracking_number')->first()->setting_value);
        settingset('tracking_number', $tracking_number);
        $title = __('setting.title');
        $max_upload_file_size = array(
            '1000' => '1MB',
            '2000' => '2MB',
            '3000' => '3MB',
            '4000' => '4MB',
            '5000' => '5MB',
            '6000' => '6MB',
            '7000' => '7MB',
            '8000' => '8MB',
            '9000' => '9MB',
            '10000' => '10MB',
        );
        return view('BE.setting.index', compact('title', 'max_upload_file_size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SettingRequest|Request $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(SettingRequest $request)
    {
        if ($request->hasFile('site_logo_file')) {
            unlinkUpload('site', settings('site_logo'));
            $site_logo = $this->uploadFile($request->site_logo_file, 'site');
            $request->merge(['site_logo' => $site_logo]);

        }
        settingset('modules', []);

        if ($request->date_format == "") {
            $request->date_format = 'd.m.Y';
        }
        if ($request->time_format == "") {
            $request->time_format = 'H:i';
        }
        $request->merge([
            'jquery_date' => $this->dateformat_PHP_to_jQueryUI($request->date_format),
            'jquery_date_time' => $this->dateformat_PHP_to_jQueryUI($request->date_format . ' ' . $request->time_format),
        ]);

        foreach ($request->except('_token', 'site_logo_file', 'date_format_custom', 'time_format_custom', 'type',
            'role') as $key => $value) {
            settingset($key, $value);
        }
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.setting.index');
    }

    /*
 * Matches each symbol of PHP date format standard
 * with jQuery equivalent codeword
 * @author Stojan Kukrika
 */
    function dateformat_PHP_to_jQueryUI($php_format)
    {
        $SYMBOLS_MATCHING = array(
            // Day
            'd' => 'DD',
            'D' => 'ddd',
            'j' => 'D',
            'l' => 'dddd',
            'N' => 'do',
            'S' => 'do',
            'w' => 'd',
            'z' => 'DDD',
            // Week
            'W' => 'w',
            // Month
            'F' => 'MMMM',
            'm' => 'MM',
            'M' => 'MMM',
            'n' => 'M',
            't' => '',
            // Year
            'L' => '',
            'o' => '',
            'Y' => 'YYYY',
            'y' => 'YY',
            // Time
            'a' => 'a',
            'A' => 'A',
            'B' => '',
            'g' => 'h',
            'G' => 'H',
            'h' => 'hh',
            'H' => 'HH',
            'i' => 'mm',
            's' => 'ss',
            'u' => ''
        );


        $jqueryui_format = "";
        $escaping = false;
        for ($i = 0; $i < strlen($php_format); $i++) {
            $char = $php_format[$i];
            if ($char === '\\') // PHP date format escaping character
            {
                $i++;
                if ($escaping) {
                    $jqueryui_format .= $php_format[$i];
                } else {
                    $jqueryui_format .= '\'' . $php_format[$i];
                }
                $escaping = true;
            } else {
                if ($escaping) {
                    $jqueryui_format .= "'";
                    $escaping = false;
                }
                if (isset($SYMBOLS_MATCHING[$char])) {
                    $jqueryui_format .= $SYMBOLS_MATCHING[$char];
                } else {
                    $jqueryui_format .= $char;
                }
            }
        }
        return $jqueryui_format;
    }

}
