<?php

namespace App\Services;

/**
 * Class BaseService
 * @package App\Services
 */
abstract class BaseService
{

    /**
     * @var RequestService
     */
    protected $requestService;

    /**
     * Set a request service.
     *
     * @param RequestService $requestService
     */
    public function __construct(RequestService $requestService)
    {
        $this->requestService = $requestService;
    }
}
