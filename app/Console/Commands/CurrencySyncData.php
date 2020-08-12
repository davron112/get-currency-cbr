<?php
namespace App\Console\Commands;

use App\Services\EntityService\Contracts\CurrencyService;
use Illuminate\Console\Command;

class CurrencySyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise data currency';

    /**
     * @var CurrencyService $currencyService
     */
    protected $currencyService;

    /**
     * CurrencySyncStatus constructor.
     *
     * @param CurrencyService $currencyService
     */
    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyService = $currencyService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->currencyService->sync();
    }
}
