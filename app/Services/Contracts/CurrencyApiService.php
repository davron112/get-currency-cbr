<?php

namespace App\Services\Contracts;

/**
 * Interface CurrencyApiService
 * @package App\Services\Contracts
 */
interface CurrencyApiService
{
    /**
     * All currencies
     *
     * @param array $data
     * @return mixed
     */
    public function getAll();
}
