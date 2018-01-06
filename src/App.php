<?php

class App extends \atk4\ui\App {
    public $db;
    public $sms;

    function __construct($mode) {
        parent::__construct('Расписние встреч');

        if ($mode == 'public') {
            $this->initLayout('Centered');
            $this->layout->add(['Header', 'Расписание встреч', 'huge centered'], 'Header');
        }elseif($mode == 'admin') {
            $this->initLayout('Admin');
            $this->layout->leftMenu->addItem(['Galvenā lapa', 'icon'=>'home'], ['index']);
            //$this->layout->leftMenu->addItem(['Admin', 'icon'=>'dashboard'], ['admin']);
            $this->layout->leftMenu->addItem(['Priekšmeti', 'icon'=>'book'], ['admin','admin'=>'lessens']);
            $this->layout->leftMenu->addItem(['Skolotāji', 'icon'=>'users'], ['admin','admin'=>'teachers']);
            $this->layout->leftMenu->addItem(['Ieraksti', 'icon'=>'unordered list'], ['admin','admin'=>'list']);
        }
        $this->db = \atk4\data\Persistence::connect('mysql://MySite:12345@localhost/scheduler');
        //$this->db = new	\atk4\data\Persistence_SQL('mysql:dbname=scheduler;host=localhost','root','');
}
}
