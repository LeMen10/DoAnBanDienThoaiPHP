<?php
require './app/core/Controller.php';

class contact extends Controller
{
    public function index()
    {
        return $this->view('main_layout', ['page' => 'contact']);
    }
}
