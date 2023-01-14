<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovimentService;
use App\Models\Group;
use App\Models\Product;
use App\Http\Requests\MovimentRequest;

class MovimentController extends Controller
{
    private MovimentService $movimentService;

    public function __construct(MovimentService $movimentService)
    {
        $this->movimentService = $movimentService;
    }

    public function store(MovimentRequest $request, Group $group, Product $product)
    {
        $movimentData = $this->movimentService->createService(
          $group, $product,
           ...array_values(
               $request->only([
                   'invested_value',
                   'type',
               ])
           )
        );
        return response()->json([
            'Dados do Investimento' => $movimentData,
            'message' => 'Investimento criado com sucesso!!!'
        ]);
    }

    public function show()
    {
        $show = $this->movimentService->showService();
        return response()->json([
            'show' => $show
        ]);
    }

}
