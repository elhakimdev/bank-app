<?php

namespace App\Services\Administrative;

use Illuminate\Support\Collection;
use App\Models\Address\Village;
use App\Models\Address\District;
use App\Models\Address\City;
use App\Models\Address\Province;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;
class BaseService
{
       protected $search;
       public function search(string $location)
       {
              $this->search  = strtoupper($location);
              return $this;
       }
       /**
        * handle request and push into new Array
        *
        * @param \Illuminate\Http\Request $request
        * @return array
        */
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
       /**
        * Convert \Illuminate\Http\Request $request Object into String
        *
        * @param \Illuminate\Http\Request $request
        * @return string
        */
       public function getResultString(Request $request): string
       {
              return "DESA : " . $this->defineRequest($request)['kelurahan'] . ", KECAMATAN : " . $this->defineRequest($request)['kecamatan'] . ", " . $this->defineRequest($request)['kabupaten'] . ", PROVINSI : " . $this->defineRequest($request)['provinsi'] . ", INDONESIA";
       }

       /**
        * Handle to check if the foreign key is already exist an same with $request->profile_id
        * cek apakah di tabel profile address belum ada record dengan profile_id / $request->id?
        * jika true, atau belum ada FK yang sama maka return $request->profile_id;
        * jika fase, atau sudah ada FK yang sama maka return false;
        * @param Request $request
        * @return boolean
        */
       public function hasSameAlreadyExistsForeignKey(Request $request)
       {
              if (ProfileAddress::where('profile_id', $request->profile_id)->doesntExist()) {
                     return $request->profile_id;
              }
              return false;
       }
       /**
        * Handle enerate a new array payload from valid sanitize request to storig or updating resources
        *
        * @param \Illuminate\Http\Request $request
        * @param integer $address
        * @return array
        */
       public function createPayloadFromRequest(Request $request, int $address = null): array
       {
              if ($request->profile_id === null) {
                     $model                      = ProfileAddress::find($address);
                     return [
                            'profile_id'        => $model->profile->id,
                            'address_detail'    => $this->getResultString($request)
                     ];
              }
              return [
                     'profile_id'        => $this->hasSameAlreadyExistsForeignKey($request),
                     'address_detail'    => $this->getResultString($request)
              ];
       }
}
