# working-days

Laravel plugin to get company data from AADE(ΑΑΔΕ) service.

## Install

This project can be installed via Composer run the following command:

```bash
composer require spyrmp/greek-company-data-by-aade
```

## Add the Service Provider & Facade/Alias

Once spyrmp/greek-company-data-by-aade is installed, you need to register the service provider in config/app.php. Make
sure to add the following line above the RouteServiceProvider.

```PHP
\Spyrmp\GreekCompanyDataByAade\GreekCompanyDataByAadeProvider::class,
```

You may add the following `aliases` to your `config/app.php`:

```PHP
'Spyrmp\GreekCompanyDataByAade' => Spyrmp\GreekCompanyDataByAade\Facades\GreekCompanyDataByAade::class,
```

Publish the package config file by running the following command:

```
php artisan vendor:publish --provider="Spyrmp\GreekCompanyDataByAade\GreekCompanyDataByAadeProvider" --tag="greek-company-data-by-aade"
```

## Usage

Get Company data

```php
$greekVatNumber = 123456789; // Greek Vat Number
$companyData = \Spyrmp\GreekCompanyDataByAade::getCompanyData($greekVatNumber);
dd($companyData); 
```
