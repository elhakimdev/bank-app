<?php

namespace App\Services\Administrative;

use Illuminate\Support\Collection;

class BaseService
{
       protected $search;
       public function search(string $location): self
       {
              $this->search  = strtoupper($location);
              return $this;
       }
}
