<?php

namespace App\Http\Controllers\Api\Actions\Address;

use App\Http\Controllers\Controller;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;

class DestroyProfileAddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $addres)
    {
        return ProfileAddress::find($addres)->delete();
    }
}
