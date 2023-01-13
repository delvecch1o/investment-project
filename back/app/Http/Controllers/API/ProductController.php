<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Instituition;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(ProductRequest $request, Instituition $instituition)
    {
        $productData = $this->productService->createService(
          $instituition, 
           ...array_values(
               $request->only([
                   'description',
                   'name',
                   'index',
                   'interest_rate',
               ])
           )
        );
        return response()->json([
            'Dados do Produto' => $productData,
            'message' => 'Produto criado com sucesso!'
        ]);
    }

    public function show(Product $product)
    {
        $show = $this->productService->showService($product);
        return response()->json([
            'show' => $show
        ]);
    }

    public function showDetails(Instituition $instituition)
    {
        $showDetailsProducts = $this->productService->showDetailsService($instituition);
        return response()->json([
            'show Details Products' => $showDetailsProducts
        ]);
    }


    public function update(ProductRequest $request, Product $product)
    {
        $productDataUpdate = $this->productService->updateService(
            $product,
            ...array_values(
                $request->only([
                    'description',
                    'name',
                    'index',
                    'interest_rate',

                ])
            )
        );
        return response()->json([
            'Dados do Produto Atualizado' => $productDataUpdate,
            'message' => 'Produto Atualizado com sucesso!'
        ]);


    }

    
    public function destroy(Product $product)
    {
        $this->productService->destroyService($product);
        return response()->json([
            'message' => 'Produto excluido com Sucesso'
        ]);
        
    }

}
