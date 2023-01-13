<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Instituition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class ProductService
{
    public function createService(Instituition $instituition, $description, $name, $index, $interest_rate)
    {
        $guardIdInstituition = $instituition->id;
      
        $productData = Product::create([
            'instituition_id' => $guardIdInstituition,
            'description' => $description,
            'name' => $name,
            'index' => $index,
            'interest_rate' => $interest_rate,
           
            
        ]);
        return $productData;
    
    }

    public function showService(Product $product)
    {
        $show = $product->get();
        return $show;
    }

    public function showDetailsService(Instituition $instituition)
    {
        $showDetails =  $instituition->products;
        return $showDetails;
    }

    public function updateService(Product $product, $description, $name, $index, $interest_rate)
    {

        $product->update([
            'description' => $description,
            'name' => $name,
            'index' => $index,
            'interest_rate' => $interest_rate,
        ]);
        return  $product;

    }
    

    public function destroyService(Product $product)
    {
        $product->delete();
    }     
       
    
}