<?php

namespace App\Services\EntityService\Contracts;

/**
 * Interface CurrencyService
 * @package App\Services\EntityService\Contracts
 */
interface CurrencyService extends BaseService
{
    /**
     * @return mixed
     */
    public function sync();
}
