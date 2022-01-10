<?php
/**
 * GreekCompanyDataByAade.php
 *
 * @copyright Copyright © 2022   All rights reserved.
 * @author    Spyros Bodinis {spyros@onecode.gr}
 */

namespace Spyrmp\GreekCompanyDataByAade\Facades;

use Illuminate\Support\Facades\Facade;

class GreekCompanyDataByAade extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'greek-company-data-by-aade';
    }
}
