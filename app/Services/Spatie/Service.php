<?php

namespace App\Services\Spatie;

class Service
{
       public $model;
       public function getModel(object $model): object
       {
              return $model->id;
       }
       public function model(object $model): object
       {
              $this->model = $model;
              return $this;
       }
}
