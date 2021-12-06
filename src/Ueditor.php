<?php

namespace Weiaibaicai\Ueditor;

use Illuminate\Support\Arr;

class Ueditor
{
    const NAME = 'ueditor';

    protected $serviceProvider = UeditorServiceProvider::class;

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $lang = __DIR__.'/../resources/lang';

    public $composer = __DIR__.'/../composer.json';

    public static function getUploadConfig($key = null, $default = null)
    {
        $config = config('ueditor') ?: (include __DIR__.'/../config/ueditor.php');

        if ($key === null) {
            return $config;
        }

        return Arr::get($config, $key, $default);
    }
}
