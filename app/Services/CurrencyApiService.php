<?php

namespace App\Services;

use App\Services\Contracts\CurrencyApiService as CurrencyApiServiceInterface;

/**
 * Class CurrencyApiService
 *
 * @package App\Services
 */
class CurrencyApiService extends BaseService implements CurrencyApiServiceInterface
{
    protected $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /*protected $requestService;

    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }*/

    /**
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAll()
    {
        return $this->requestService->makeGetRequest($this->url);
    }
}
