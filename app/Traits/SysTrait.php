<?php

namespace App\Traits;


/**
 * 
 */
trait SysTrait
{
    public function GetLangFile()
    {
        return include lang_path(app()->getLocale() . '/app.php');
    }
    public function GetCountries()
    {
        return json_decode(file_get_contents(config_path('info/Countries.json')), true);
    }
    public function AddSysLog($who, $do, $note = null)
    {
        $cb = fopen(config_path('info/logs/sys.txt'), 'a');
        fwrite($cb, '## ' . date(config('app.date.format')) . ' (' . $who . ')' . '| DO =>{' . $do . '}' . '|' . $note . '|##' . PHP_EOL);
        fclose($cb);
    }
    public function ViewHent($mess, $theme = "Info", $title = null) //["Light","Primary","Danger","Warning","Success","Info","Dark"]
    {
        session()->flash('hent');
        session()->flash('theme', $theme);
        session()->flash('title', $title);
        session()->flash('mess', $mess);
    }
    public function ViewAlert($mess, $style = "Info")
    {
        session()->flash('alert');
        session()->flash('mess', $mess);
        session()->flash('style', $style);
    }
}
