<?php
namespace Model;

class Timeslot extends \atk4\data\Model {
    public $table = 'timeslot';
    public $title = 'Время';

    function init() {
        parent::init();
        $this->addField('time');
        $this->hasOne('day_id', new Day());
    }
}
