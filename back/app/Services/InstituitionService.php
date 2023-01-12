<?php

namespace App\Services;

use App\Models\Instituition;

class InstituitionService
{
    public function createService($name)
    {
        $instituitionData = Instituition::create([
            'name' => $name,
            
        ]);
        return $instituitionData;
    }

    public function showService(Instituition $instituition)
    {
        $show = $instituition->all();
        return $show;
    }

    public function showDetailsService(Instituition $instituition)
    {
        $showDetails = $instituition->find($instituition);
        return $showDetails;
    }

    public function updateService(Instituition $instituition, $name)
    {
        $instituition->update([
            'name' => $name,
            
        ]);
        return  $instituition;

    }

    public function destroyService(Instituition $instituition)
    {
        $instituition->delete();
    }


}