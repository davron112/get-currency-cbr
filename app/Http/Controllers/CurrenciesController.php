<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Presenters\CurrencyPresenter;
use App\Repositories\Contracts\CurrencyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CurrenciesController extends Controller
{

    public function index(
        Request $request,
        CurrencyRepository $repository
    )
    {
        $input = $request->all();
        $limit = Arr::get($input, 'limit', 10);

        $currencies = $repository
            ->setPresenter(CurrencyPresenter::class)
            ->paginate($limit);

        return response()->json($currencies);
    }

    public function show($id, CurrencyRepository $repository)
    {
        $currency = $repository
            ->setPresenter(CurrencyPresenter::class)->find($id);
        return response()->json($currency);
    }
}
