<?php

namespace App\Services\Administrative;

use App\Models\Address\Village;
use App\Models\Address\District;
use App\Models\Address\City;
use App\Models\Address\Province;
use Illuminate\Http\Request;

class ResourceService implements ResourceServiceInterface
{
       public function defineRequest(Request $request): array
       {
              $kelurahan  = Village::find($request->desa);
              $kecamatan  = District::find($request->kecamatan);
              $kabupaten  = City::find($request->kabupaten);
              $provinsi   = Province::find($request->provinsi);
              return [
                     'kelurahan'  => $kelurahan->name,
                     'kecamatan'  => $kecamatan->name,
                     'kabupaten'  => $kabupaten->name,
                     'provinsi'   => $provinsi->name,
              ];
       }
       public function getResultString(Request $request): string
       {
              return "DESA : " . $this->defineRequest($request)['kelurahan'] . ", KECAMATAN : " . $this->defineRequest($request)['kecamatan'] . ", " . $this->defineRequest($request)['kabupaten'] . ", PROVINSI : " . $this->defineRequest($request)['provinsi'] . ", INDONESIA";
       }
       public function createPayloadFromRequest(Request $request): array
       {
              return [
                     'profile_id'        => $request->profile_id,
                     'address_detail'    => $this->getResultString($request)
              ];
       }
}
