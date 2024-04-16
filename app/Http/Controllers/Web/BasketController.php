<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketAddRequest;
use App\Services\BasketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final class BasketController extends Controller
{
    public function __construct(private BasketService $basketService)
    {
    }

    public function show()
    {
        [$basketItems, $total] = $this->basketService->show();
        return view('basket.show', compact('basketItems', 'total'));
    }

    public function add(BasketAddRequest $request): RedirectResponse
    {
        $this->basketService->add($request->toDto());
        return Redirect::back();
    }
}
