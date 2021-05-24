<?php

namespace App\Http\Controllers\Api\Actions\Address;

use App\Services\Administrative\ResourceService;
use App\Models\Address\Village;
use App\Models\Address\District;
use App\Models\Address\City;
use App\Models\Address\Province;
use App\Http\Controllers\Controller;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;

class updateProfileAddressController extends Controller
{
    public $service;
    public function __construct(ResourceService $service)
    {
        $this->service = $service;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $address, Request $request)
    {
        return $this->service->update($address, $request);
    }
}
