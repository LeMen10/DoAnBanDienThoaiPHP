<?php
require './app/core/Controller.php';

class myerror extends Controller
{
    public function badRequest(){
        return $this->view('null_layout', ['page' => 'error/400']);
    }

    public function forbidden(){
        return $this->view('null_layout', ['page' => 'error/403']);
    }
}