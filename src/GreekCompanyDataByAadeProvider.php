<?php

namespace Spyrmp\GreekCompanyDataByAade;


use Illuminate\Support\ServiceProvider;

class GreekCompanyDataByAadeProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('greek-company-data-by-aade', function ($app) {

            return new GreekCompanyDataByAade($app['config']);
        });
    }

    public function boot()
    {
        $this->loadConfig();
    }

    private function loadConfig()
    {
        $configPath = $this->packagePath('config/greek-company-data-by-aade.php');
        $this->mergeConfigFrom($configPath, 'greek-company-data-by-aade');
        $this->publishes([$configPath => config_path('greek-company-data-by-aade.php')], 'greek-company-data-by-aade');
    }

    private function packagePath($path)
    {
        return __DIR__ . "/../$path";
    }

}
