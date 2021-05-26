<?php

namespace App\Http\Controllers\API\Actions\Address;

use App\Services\Administrative\ResourceService;
use App\Http\Controllers\Controller;

class DestroyProfileAddressController extends Controller
{
    public $resource;
    public function __construct(ResourceService $resource)
    {
        $this->resource = $resource;
    }
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $addres)
    {
        $this->resource->delete($addres);
    }
}
