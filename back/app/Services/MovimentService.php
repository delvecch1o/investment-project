<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Product;
use App\Models\Moviment;

class MovimentService
{
    public function createService(Group $group,Product $product, $invested_value, $type)
    {
        $guardIdUser = Auth::user()->id;
        $guardIdIGroup = $group->id;
        $guardIdProduct = $product->id;
        
        $guardInterestRate = $product->interest_rate;
        $amountWithInterest =  $guardInterestRate * $invested_value;
        $amountToTithdraw =  $amountWithInterest + $invested_value;
        
        if($type == 1)
        {
            $movimentData = Moviment::create([
                'invested_value' => $invested_value,
                'type' => $type,
                'get_value' => $amountToTithdraw,
                'user_id' => $guardIdUser,
                'group_id' => $guardIdIGroup,
                'product_id' => $guardIdProduct,
                
            ]);
            return $movimentData;
        }

        elseif($type == 2)
        {
           return 'Retirar';
        }
        else
        {
            throw ValidationException::withMessages(
                ['message' => 
                'Opção invalida tente 1 para investir Ou 2 para retirar'
            ]);
        }
      
    
    }

    public function showService()
    {
        $user = Auth::user();
        $show = $user->moviment()->get();
        return $show;
    }

}
