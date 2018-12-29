<?php

namespace App\Http\Controllers\Traits;

use Validator;
use App\Family\Merchant;
use Illuminate\Http\Request;

trait CreatesNewMerchants
{
    protected function shouldCreateNewMerchant(Request $request)
    {
        Validator::make($request->all(), [
            'merchant_id' => 'required_without:merchant_name',
            'merchant_name' => 'required_without:merchant_id',
        ], [
            'required_without' => 'Please select a merchant',
        ])->validate();

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
