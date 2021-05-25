<?php

namespace App\Services\Spatie;

/**
 * -------------------------------------
 * Class Service
 * -------------------------------------
 * Base class to handle spatie role permission service, all spatie service class must be extend this class
 * 
 * @author ElhakimDev <abdulelhakim68@gmail.com>
 * @version 1.0.0
 */
class Service
{
       /**
        * Model
        *
        * @var $model
        */
       public $model;
       /**
        * Define model
        *
        * @param object $model
        * @return self
        */
       public function model(object $model): self
       {
              $this->model = $model;
              return $this;
       }
       /**
        * Get model_id
        *
        * @param object $model
        * @return self
        */
       public function getModel(object $model): self
       {
              return $model->id;
       }
}
