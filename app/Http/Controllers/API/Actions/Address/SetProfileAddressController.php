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
use Illuminate\Http\Request;

class SetProfileAddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $kelurahan  = Village::find($request->desa);
        $kecamatan  = District::find($request->kecamatan);
        $kabupaten  = City::find($request->kabupaten);
        $provinsi   = Province::find($request->provinsi);
        $final_address = "Desa : " . $kelurahan->name . ", Kecamatan : " . $kecamatan->name . ", " . $kabupaten->name . ", Provinsi : " . $provinsi->name . ", Indonesia";
        $payload = [
            'profile_id'        => $request->profile_id,
            'address_detail'    => $final_address
        ];
        return ProfileAddress::create($payload);
    }
}
