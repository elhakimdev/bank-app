<?php

namespace App\Http\Controllers\API\Actions\Address;

use App\Http\Controllers\Controller;
use App\Models\Address\City;
use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Village;
use App\Models\Profile;
use App\Models\ProfileAddress;
use App\Models\User;
use App\Services\Administrative\ResourceService;
use Illuminate\Http\Request;

class SetProfileAddressController extends Controller
{
    public $service;
    public function __construct(ResourceService $service)
    {
        $this->service = $service;
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
        if ($this->service->hasSameAlreadyExistsForeignKey($request)) {
            return ProfileAddress::create($this->service->createPayloadFromRequest($request));
        }
        return json_encode(response("The given profile_id already exists", 422));
    }
}
