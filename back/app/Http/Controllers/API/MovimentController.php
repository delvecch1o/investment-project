<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovimentService;
use App\Models\Group;
use App\Models\Product;
use App\Models\Moviment;
use App\Http\Requests\MovimentRequest;
use App\Http\Requests\WithdrawValueRequest;


class MovimentController extends Controller
{
    private MovimentService $movimentService;

    public function __construct(MovimentService $movimentService)
    {
        $this->movimentService = $movimentService;
    }

    public function store(MovimentRequest $request, Group $group, Product $product)
    {
        $movimentData = $this->movimentService->createInvestmentService(
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
            'message' => 'Investimento realizado com sucesso!!!'
        ]);
    }

    public function withdrawValue(WithdrawValueRequest $request,Moviment $moviment)
    {
        $withdrawValueData = $this->movimentService->withdrawValueService(
            $moviment,
             ...array_values(
                 $request->only([
                     'type',
                 ])
             )
          );
          return response()->json([
              'Dados do Saque' => $withdrawValueData,
              'message' => 'Valor resgatado com sucesso!!!'
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
