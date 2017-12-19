<?php
namespace Model;

class Timeslot extends \atk4\data\Model {
    public $table = 'timeslot';
    public $title = 'Время';

    function init() {
        parent::init();
        $this->addField('time');
        $this->hasMany('Inter', new Inter());
        $this->hasMany('id', new Parents());
    }
}
