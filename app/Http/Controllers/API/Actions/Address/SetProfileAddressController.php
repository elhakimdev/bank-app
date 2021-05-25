<?php

namespace App\Http\Controllers\API\Actions\Address;

use App\Services\Administrative\ResourceService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetProfileAddressController extends Controller
{
    public $resource;
    public function __construct(ResourceService $resource)
    {
        $this->resource = $resource;
    }
    /**
     * Handle the incoming request.
     * We aggred to check is Foreign Key Already Same Exists before perform running this action to prevent store same Foreign Key on this model. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $this->resource->store($request);
    }
}
