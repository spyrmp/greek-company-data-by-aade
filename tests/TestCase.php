<?php

namespace Spyrmp\GreekCompanyDataByAade\Tests;

use Illuminate\Contracts\Console\Kernel;
use RicorocksDigitalAgency\Soap\Providers\SoapServiceProvider;
use Spyrmp\GreekCompanyDataByAade\Facades\GreekCompanyDataByAade;
use Spyrmp\GreekCompanyDataByAade\GreekCompanyDataByAadeProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        global $argv, $argc;
        if ($argc == 7) {
            config(["greek-company-data-by-aade.aade_wsdl" => $argv[2]]);
            config(["greek-company-data-by-aade.aade_username" => $argv[3]]);
            config(["greek-company-data-by-aade.aade_password" => $argv[4]]);
            config(["greek-company-data-by-aade.afm_called_by" => $argv[5]]);
        }
        # dd(config("greek-company-data-by-aade"));
        return [
            GreekCompanyDataByAadeProvider::class,
            SoapServiceProvider::class
        ];

    }

    protected function getPackageAliases($app)
    {
        return [
            "Spyrmp\GreekCompanyDataByAade" => GreekCompanyDataByAade::class,
        ];
    }


}
