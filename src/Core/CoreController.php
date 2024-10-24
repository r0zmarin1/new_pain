<?php
namespace App\Core;
class CoreController
{
    public $model;
	public $view;
    public function __construct()
    {
        $this->view = new CoreView('');
        $this->model = new CoreModel();
    }

}