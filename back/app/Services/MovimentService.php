<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Models\Product;
use App\Models\Moviment;

class MovimentService
{
    public function createInvestmentService(Group $group,Product $product, $invested_value, $type)
    {
        $userWallet = Auth::user()->wallet()->first();
        if($userWallet->balance < $invested_value)
        {
            throw ValidationException::withMessages(
                ['message' => 
                'Você não tem saldo suficiente para reqalizar o investimento',
                'Saldo => ' .$userWallet->balance
            ]);
                
        }
       
        $guardInterestRate = $product->interest_rate;                  // pega a taxa de juros para ser multiplicado
        $amountWithInterest =  $guardInterestRate * $invested_value;  // valor que vai render com juros
        $amountToTithdraw =  $amountWithInterest + $invested_value;  // soma o valor investido e mais o juros
       
        $guardIdUser = Auth::user()->id;
        $guardIdIGroup = $group->id;
        $guardIdProduct = $product->id;

        $payload =[
            'invested_value' => $invested_value,
            'type' => $type,
            'get_value' => $amountToTithdraw,
            'user_id' => $guardIdUser,
            'group_id' => $guardIdIGroup,
            'product_id' => $guardIdProduct,
        ];

        $transactionResult = DB::transaction(function () use ($payload, $userWallet, $invested_value){

            $transaction = Moviment::create($payload);
        
            $userWallet->balance -= $invested_value;
            $userWallet->save();

            return $transaction;
        });

        return $transactionResult;
    }


    public function withdrawValueService(Moviment $moviment, $type)
    {
        $user = Auth::user();
        $userWallet = Auth::user()->wallet()->first(); // acessa a carteira do usuario autenticado
        $investmentPayer = $moviment;                  // acessa o valor com juros aplicado
        
        if($investmentPayer->get_value == 0.00)
        {
            throw ValidationException::withMessages(
                ['message' => 
                'O valor ja foi retirado da aplicação'
            ]);
        }
        
        $userWallet->balance += $investmentPayer->get_value;
        $userWallet->save();

        $moviment->update([
            'type' => $type,
            'invested_value' => 0.00,
            'get_value' => 0.00
        ]);

        return $userWallet;
 
    }

    public function showService()
    {
        $user = Auth::user();
        $show = $user->moviment()->get();
        return $show;
    }

}
