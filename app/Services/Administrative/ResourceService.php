<?php

namespace App\Services\Administrative;

use App\Models\Address\Village;
use App\Models\Address\District;
use App\Models\Address\City;
use App\Models\Address\Province;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;
use Exception;

class ResourceService implements ResourceServiceInterface
{
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
       public function store(Request $request)
       {
              try {
                     if ($this->hasSameAlreadyExistsForeignKey($request)) {
                            return ProfileAddress::create($this->createPayloadFromRequest($request));
                     }
                     throw new Exception('Given profile_id : ' . $request->profile_id . ' has been already exist', 422);
              } catch (Exception $e) {
                     return response(
                            json_encode([
                                   "status"    => "UNPROCESSABLE ENTITY",
                                   "code"      => $e->getCode(),
                                   "message"   => $e->getMessage()
                            ]),
                            422
                     );
              }
       }
       public function update(int $address, Request $request)
       {
              $data       = ProfileAddress::find($address);
              return $data->update($this->createPayloadFromRequest($request, $address));
       }
       public function delete(int $addres)
       {
              return ProfileAddress::find($addres)->delete();
       }
}
