<?php

namespace App\Services\EntityService;

use App\Repositories\Contracts\CurrencyRepository;
use App\Services\Contracts\CurrencyApiService;
use App\Services\EntityService\Contracts\CurrencyService as CurrencyServiceInterface;
use Illuminate\Database\DatabaseManager;
use Exception;
use Illuminate\Log\Logger;

/**
 * Class CurrencyService
 *
 * @package App\Services\EntityService
 * @method bool destroy
 */
class CurrencyService  extends BaseService implements CurrencyServiceInterface
{
    /**
     * @var DatabaseManager
     */
    protected $databaseManager;

    /**
     * @var Logger $repository
     */
    protected $logger;

    /**
     * @var CurrencyRepository
     */
    protected $repository;

    /**
     * @var CurrencyApiService
     */
    protected $apiService;

    /**
     * CurrencyService constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param Logger $logger
     * @param CurrencyRepository $repository
     */
    public function __construct(
        DatabaseManager $databaseManager,
        Logger $logger,
        CurrencyRepository $repository,
        CurrencyApiService $apiService
    ) {

        $this->databaseManager     = $databaseManager;
        $this->logger     = $logger;
        $this->repository     = $repository;
        $this->apiService     = $apiService;
    }

    /**
     * @return mixed|void
     * @throws \Throwable
     */
    public function sync()
    {
        $this->beginTransaction();

        try {
            $rates = $this->apiService->getAll();

            if (empty($rates)) {
                throw new Exception('Data not found');
            }

            foreach ($rates as $rate) {


                $separator = strlen(preg_replace('#\d+,#', '', $rate->Value));
                $rateValue = (int) preg_replace('#,|\.|\s#', '', $rate->Value);

                $currency = $this->repository->updateOrCreate(
                    [
                        'name'      => $rate->Name,
                    ],
                    [
                        'rate'      => $rateValue,
                        'separator' => $separator,
                    ]
                );

                if ($currency->rate != $rateValue) {
                    $currency->update(['rate' => $rateValue]);
                }
            }
        } catch (Exception $e) {
            $this->rollback($e, $e->getMessage());
        }

        $this->commit();
    }

}
