<?php

class App extends \atk4\ui\App {
    public $db;
    public $sms;

    function __construct($mode) {
        parent::__construct('Чето по русски');

        if ($mode == 'public') {
            $this->initLayout('Centered');
            $this->layout->add(['Header', 'Расписание встреч', 'huge centered'], 'Header');
        }elseif($mode == 'admin') {
            $this->initLayout('Admin');
            $this->layout->leftMenu->addItem(['Front-end demo', 'icon'=>'puzzle'], ['index']);
            $this->layout->leftMenu->addItem(['Admin demo', 'icon'=>'dashboard'], ['admin']);
        }
        $this->db = \atk4\data\Persistence::connect('mysql://MySite:12345@localhost/scheduler');
}
}
