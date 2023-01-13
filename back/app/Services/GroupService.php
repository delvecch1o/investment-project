<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Instituition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class GroupService
{
    public function createService(Instituition $instituition, $name)
    {
        $guardIdUser = Auth::user()->id;
        $guardIdInstituition = $instituition->id;
      
        $instituitionData = Group::create([
            'name' => $name,
            'user_id' => $guardIdUser,
            'instituition_id' => $guardIdInstituition,
            
        ]);
        return $instituitionData;
    
    }

    public function showService()
    {
        $user = Auth::user();
        $show = $user->group()->get();
        return $show;
    }

    public function showDetailsService(Group $group)
    {
        $user = Auth::user();
        $showDetails =  $user->group()->find($group->id);
        return $showDetails;
    }

    public function updateService(Group $group,  $name)
    {
        $user = Auth::user();
        $group =  $user->group()->find($group->id);
        $group->update([
            'name' => $name,
        ]);
        return  $group;

    }

    public function destroyService(Group $group)
    {
        $user = Auth::user();
        $group =  $user->group()->find($group->id);
        $group->delete();
    }     
       
    
}