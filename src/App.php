<?php

class App extends \atk4\ui\App {
    public $db;
    public $sms;

    function __construct($mode) {
        parent::__construct('Vecāku diena');

        if ($mode == 'public') {
            $this->initLayout('Centered');
        }elseif($mode == 'admin') {
            $this->initLayout('Admin');
            $this->layout->leftMenu->addItem(['Galvenā lapa', 'icon'=>'home'], ['index']);
            //$this->layout->leftMenu->addItem(['Admin', 'icon'=>'dashboard'], ['admin']);
            $this->layout->leftMenu->addItem(['Priekšmeti', 'icon'=>'book'], ['admin','check'=>'lessens']);
            $this->layout->leftMenu->addItem(['Skolotāji', 'icon'=>'users'], ['admin','check'=>'teachers']);
            $this->layout->leftMenu->addItem(['Ieraksti', 'icon'=>'unordered list'], ['admin','check'=>'list']);
        }
       if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
            $this->db = \atk4\data\Persistence::connect($_ENV['CLEARDB_DATABASE_URL']);
        } else {
            $this->db = \atk4\data\Persistence::connect('mysql:host=127.0.0.1;dbname=scheduler;charset=utf8', 'root', '');
        }

        $this->layout->template->del('Header');

        $logo = 'logo.png';

        $this->layout->add(['image',$logo,'small centered'],'Header');

        $this->layout->add([
            'Header',
            'Center-aligned',
            'size'=>'huge',
            'aligned' => 'center',
            'subHeader' => 'header with icon'
        ], 'Header');
}
}
