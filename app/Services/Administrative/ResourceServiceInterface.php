<?php

namespace App\Services\Administrative;

use Illuminate\Http\Request;

interface ResourceServiceInterface
{
       public function store(Request $request);
       public function update(int $address, Request $request);
       public function delete(int $addres);
}
