<?php

namespace App\Services\Administrative;

use App\Models\Address\Village;
use App\Models\Address\District;
use App\Models\Address\City;
use App\Models\Address\Province;
use App\Models\ProfileAddress;
use App\Models\Profile;
use Illuminate\Http\Request;
class BaseService
{
       /**
        * @var search
        */
       protected $search;

       /**
        * Search model
        *
        * @param string $location
        * @return void
        */
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
       public function __collect(Request $request): array
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
       public function __results(Request $request): string
       {
              return "DESA : " . $this->__collect($request)['kelurahan'] . ", KECAMATAN : " . $this->__collect($request)['kecamatan'] . ", " . $this->__collect($request)['kabupaten'] . ", PROVINSI : " . $this->__collect($request)['provinsi'] . ", INDONESIA";
       }

       /**
        * Handle to check if the foreign key is already exist an same with $request->profile_id
        * cek apakah di tabel profile address belum ada record dengan profile_id / $request->id?
        * jika true, atau belum ada FK yang sama maka return $request->profile_id;
        * jika fase, atau sudah ada FK yang sama maka return false;
        * @param Request $request
        * @return boolean
        */
       public function isNotExistForeignKey(Request $request)
       {
              if (ProfileAddress::IsNotExist($request)) {
                     return $request->profile_id;
              }
              return false;
       }
       public function isProfileExist(Request $request): bool
       {
              if (Profile::find($request->profile_id)) {
                     return true;
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
       public function payloads(Request $request, int $address = null): array
       {
              if ($request->profile_id === null) {
                     $model                      = ProfileAddress::find($address);
                     return [
                            'profile_id'        => $model->profile->id,
                            'address_detail'    => $this->__results($request)
                     ];
              }
              return [
                     'profile_id'        => $this->isNotExistForeignKey($request),
                     'address_detail'    => $this->__results($request)
              ];
       }
}
