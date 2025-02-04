<?php
    namespace controller;

    class HomeController extends Controller{
        public function index(){
            $this->loadView('index');
        }
        // public function index123(){
        //     return "ddg";
        // }
    }
?>