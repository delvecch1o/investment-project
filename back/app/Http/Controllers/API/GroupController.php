<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Models\Instituition;
use App\Models\Group;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
    private GroupService $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function store(GroupRequest $request, Instituition $instituition)
    {
        $groupData = $this->groupService->createService(
          $instituition, 
           ...array_values(
               $request->only([
                   'name',
               ])
           )
        );
        return response()->json([
            'Dados do Grupo' => $groupData,
            'message' => 'Grupo criado com sucesso!'
        ]);
    }

    public function show()
    {
        $show = $this->groupService->showService();
        return response()->json([
            'show' => $show
        ]);
    }

    public function showDetails(Group $group)
    {
        $showDetails = $this->groupService->showDetailsService($group);
        return response()->json([
            'showDetails' => $showDetails
        ]);
    }
       
    public function update(GroupRequest $request, Group $group)
    {
        $groupDataUpdate = $this->groupService->updateService(
            $group,
            ...array_values(
                $request->only([
                    'name',

                ])
            )
        );
        return response()->json([
            'Dados do Grupo' => $groupDataUpdate,
            'message' => 'Grupo Atualizado com sucesso!'
        ]);


    }

    
    public function destroy(Group $group)
    {
        $this->groupService->destroyService($group);
        return response()->json([
            'message' => 'Grupo excluido com Sucesso'
        ]);
        
    }

}
