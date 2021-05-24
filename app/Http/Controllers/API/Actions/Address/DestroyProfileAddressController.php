<?php

namespace App\Http\Controllers\Api\Actions\Address;

use App\Http\Controllers\Controller;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;
use App\Services\Administrative\ResourceService;
class DestroyProfileAddressController extends Controller
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
    public function __invoke(int $addres)
    {
        $this->service->delete($addres);
    }
}
