<?php

namespace Weiaibaicai\Ueditor;

use Dcat\Admin\Admin;
use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Form;
use Weiaibaicai\Ueditor\Form\UEditor as UEditorForm;

class UeditorServiceProvider extends ServiceProvider
{

    protected $js = [
        'ueditor.config.js',
        'ueditor.all.js',
        'ueditor.parse.js',
    ];

    public function register()
    {
        //
    }

    public function init()
    {
        $extension = new Ueditor;

        if ($views = $extension->views) {
            $this->loadViewsFrom($views, Ueditor::NAME);
        }

        if ($lang = $extension->lang) {
            $this->loadTranslationsFrom($lang, Ueditor::NAME);
        }
        Form::extend('ueditor', UEditorForm::class);

        $this->app->booted(function () {
            Admin::app()->routes(function ($router) {
                $attributes = array_merge([
                    'prefix'     => config('admin.route.prefix'),
                    'middleware' => config('admin.route.middleware'),
                ], $this->config('route', []));

                $router->group($attributes, __DIR__ . '/Http/routes.php');
            });
        });

        $this->publishes([
            __DIR__.'/config/ueditor.php' => config_path('ueditor.php'),
        ], 'config');

        parent::init();

    }

    public function settingForm()
    {
        return new Setting($this);
    }
}
