<?php

namespace App\Services\Authentication;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

interface AuthenticatedTokenInterface
{
       public function store(Request $request): JsonResponse;
       public function destroy(Request $request): JsonResponse;
}
