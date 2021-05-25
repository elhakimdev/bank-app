<?php

namespace App\Http\Controllers\Api\Actions\Address;

use App\Services\Administrative\ResourceService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class updateProfileAddressController extends Controller
{
    public $resource;
    public function __construct(ResourceService $resource)
    {
        $this->resource = $resource;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $address, Request $request)
    {
        return $this->resource->update($address, $request);
    }
}
