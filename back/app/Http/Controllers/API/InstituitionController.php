<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\InstituitionService;
use App\Http\Requests\InstituitionRequest;
use App\Models\Instituition;

class InstituitionController extends Controller
{
    private InstituitionService $instituitionService;
  
    public function __construct(InstituitionService $instituitionService)
    {
        $this->instituitionService = $instituitionService;
    }
    
    public function store(InstituitionRequest $request)
    {
        $data = $this->instituitionService->createService(
            ...array_values(
                $request->only([
                    'name', 
                ])
            )
        );
            return response()->json([
                'Nome da Instituição' => $data,
                'message' => 'Instituição cadastrada com Sucesso!'
            ]);
       
    }

   
    public function show(Instituition $instituition)
    {
        $show = $this->instituitionService->showService($instituition);
        return response()->json([
            'show' => $show
        ]);
    }

    public function showDetails(Instituition $instituition)
    {
        $showDetails = $this->instituitionService->showDetailsService($instituition);
        return response()->json([
            'showDetails' => $showDetails
        ]);
    }

    
    public function update(InstituitionRequest $request, Instituition $instituition)
    {
        $data = $this->instituitionService->updateService(
            $instituition,
            ...array_values(
                $request->only([
                    'name',

                ])
            )
        );
        return response()->json([
            'Nome da Instituição' => $data,
            'message' => 'Instituição Atualizada com Sucesso!'
        ]);


    }

    
    public function destroy(Instituition $instituition)
    {
        $this->instituitionService->destroyService($instituition);
        return response()->json([
            'message' => 'Instituição financeira excluida com Sucesso'
        ]);
        
    }
}
