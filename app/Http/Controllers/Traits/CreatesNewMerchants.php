<?php

namespace App\Http\Controllers\Traits;


use App\Family\Merchant;
use Illuminate\Http\Request;

trait CreatesNewMerchants
{
    protected function shouldCreateNewMerchant(Request $request)
    {
        return ($request->has('merchant_name') && !$request->get('merchant_id'));
    }

    protected function createNewMerchant(Request $request)
    {
        $merchant = new Merchant();
        $merchant->name                 = $request->get('merchant_name');
        $merchant->default_category_id  = $request->get('category_id');
        $merchant->default_sub_category = $request->get('sub_category');

        $merchant->save();

        return $merchant;
    }
}
