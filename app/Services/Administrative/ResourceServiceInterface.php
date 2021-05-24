<?php

namespace App\Services\Administrative;

use Illuminate\Http\Request;

interface ResourceServiceInterface
{
       public function defineRequest(Request $request);
       public function createPayloadFromRequest(Request $request);
}
