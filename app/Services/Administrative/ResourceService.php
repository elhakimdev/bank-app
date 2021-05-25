<?php

namespace App\Services\Administrative;

use App\Exceptions\isNotExistException;
use App\Models\ProfileAddress;
use Illuminate\Http\Request;

class ResourceService extends BaseService implements ResourceServiceInterface
{
       /**
        * Storing payload from request data, and thrown an Exception when result is false
        *
        * @param Request $request
        * @return void
        */
       public function store(Request $request)
       {
              // if ($this->isProfileExist($request)) {
                     // return 'adaprofile';
                     if ($this->isNotExistForeignKey($request)) {
                            return ProfileAddress::create($this->payloads($request));
                            }
                     throw new isNotExistException();
              // }
              // return 'throw query constraint exception';
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
              return $data->update($this->payloads($request, $address));
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
