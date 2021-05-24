<?php

namespace App\Http\Controllers\Api\Actions\Address;

use App\Models\Address\Village;
use App\Models\Address\District;
use App\Models\Address\City;
use App\Models\Address\Province;
use App\Http\Controllers\Controller;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;

class updateProfileAddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(int $address, Request $request)
    {
        $data = ProfileAddress::find($address);
        $kelurahan  = Village::find($request->desa);
        $kecamatan  = District::find($request->kecamatan);
        $kabupaten  = City::find($request->kabupaten);
        $provinsi   = Province::find($request->provinsi);
        $final_address = "Desa : " . $kelurahan->name . ", Kecamatan : " . $kecamatan->name . ", " . $kabupaten->name . ", Provinsi : " . $provinsi->name . ", Indonesia";
        $payload = [
            'profile_id'        => $data->profile->id,
            'address_detail'    => $final_address
        ];
        return $data->update($payload);
    }
}
