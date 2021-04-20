<?php

namespace App\Services\Spatie;

class Service
{
       /**
        * Instance A Model
        *
        * @var [type]
        */
       public $model;
       /**
        * get model id
        *
        * @param object $model
        * @return void
        */
       public function getModel(object $model): object
       {
              return $model->id;
       }

       /**
        * set model property
        *
        * @param object $model
        * @return void
        */
       public function model(object $model): object
       {
              $this->model = $model;
              return $this;
       }
}
