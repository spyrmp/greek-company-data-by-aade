<?php

namespace Spyrmp\GreekCompanyDataByAade;

use Illuminate\Contracts\Config\Repository;
use PHPUnit\Util\Xml\Exception;
use RicorocksDigitalAgency\Soap\Facades\Soap;
use RicorocksDigitalAgency\Soap\Response\Response;
use stdClass;

class GreekCompanyDataByAade
{

    /**
     * @var string
     */
    private $wsdl;
    /**
     * @var string
     */
    private $username;
    /**
     * @var stdClass
     */
    private $auth;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $afm_called_by;

    /**
     * @param Repository $config
     * @return void
     */
    public function __construct($config)
    {
        $this->wsdl = $config->get("greek-company-data-by-aade.aade_wsdl");
        $this->username = $config->get("greek-company-data-by-aade.aade_username");
        $this->password = $config->get("greek-company-data-by-aade.aade_password");
        $this->afm_called_by = $config->get("greek-company-data-by-aade.afm_called_by");
        $this->auth = new stdClass();
        $this->auth->UsernameToken = new stdClass();


    }

    public function getCompanyData($vatNumber)
    {


        if (!$this->wsdl || !$this->username || !$this->password || !$this->afm_called_by) {
            throw new Exception("Add config values ./config/greek-company-data-by-aade.php");
        }
        $this->auth->UsernameToken->Username = $this->username;
        $this->auth->UsernameToken->Password = $this->password;
        $header = Soap::header("Security",
            "http://rgwspublic2/RgWsPublic2",
            $this->auth
        );

        /** @var Response $companyData */
        $companyData = Soap::to($this->wsdl)
            ->withOptions(['soap_version' => SOAP_1_2])
            ->trace()
            ->withHeaders($header)
            ->rgWsPublic2AfmMethod([
                "INPUT_REC" => [
                    "afm_called_by" => $this->afm_called_by,
                    "afm_called_for" => $vatNumber
                ]
            ]);

        if ($companyData->response->result->rg_ws_public2_result_rtType->error_rec->error_descr) {
            throw new \Exception($companyData->response->result->rg_ws_public2_result_rtType->error_rec->error_descr);
        }

        return [
            "vat_number" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->afm),
            "company_name" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->onomasia),
            "legal_status" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->legal_status_descr),
            "address" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->postal_address),
            "address_no" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->postal_address_no),
            "postal_code" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->postal_zip_code),
            "district" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->postal_area_description),
            "tax_office_code" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->doy),
            "tax_office" => trim($companyData->response->result->rg_ws_public2_result_rtType->basic_rec->doy_descr),
        ];

    }
}
