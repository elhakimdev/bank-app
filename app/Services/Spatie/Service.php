<?php

namespace App\Services\Spatie;

class Service
{
       public $model;
       public function getModel(object $model): self
       {
              return $model->id;
       }
       public function model(object $model): self
       {
              $this->model = $model;
              return $this;
       }
}
