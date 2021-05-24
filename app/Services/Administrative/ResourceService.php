<?php

namespace App\Services\Administrative;

use App\Models\ProfileAddress;
use Illuminate\Http\Request;
use Exception;

class ResourceService extends BaseService implements ResourceServiceInterface
{
       /**
        * Storing payload from request data
        *
        * @param Request $request
        * @return void
        */
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

       /**
        * Updating payload from request data
        *
        * @param integer $address
        * @param Request $request
        * @return void
        */
       public function update(int $address, Request $request)
       {
              $data       = ProfileAddress::find($address);
              return $data->update($this->createPayloadFromRequest($request, $address));
       }

       /**
        * Destroying payload from request data
        *
        * @param integer $addres
        * @return void
        */
       public function delete(int $addres)
       {
              return ProfileAddress::find($addres)->delete();
       }
}
