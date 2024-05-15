<?php
require './app/core/Controller.php';

class about extends Controller
{
    public function index()
    {
        return $this->view('main_layout', ['page' => 'about']);
    }
}
