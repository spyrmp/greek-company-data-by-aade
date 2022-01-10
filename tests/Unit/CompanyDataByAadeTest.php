<?php
/**
 * CompanyDataByAadeTest.php
 *
 * @copyright Copyright © 2022   All rights reserved.
 * @author    Spyros Bodinis {spyros@onecode.gr}
 */

namespace Spyrmp\GreekCompanyDataByAade\Tests\Unit;

use Spyrmp\GreekCompanyDataByAade;
use Spyrmp\GreekCompanyDataByAade\Tests\TestCase;

class CompanyDataByAadeTest extends TestCase
{


    public function test_company_data()
    {

        global $argv;
        #dd($this->app->getLoadedProviders());
        $company = GreekCompanyDataByAade::getCompanyData($argv[6]);
        $this->assertIsArray($company);
    }


}
