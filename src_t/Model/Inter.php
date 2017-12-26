<?php
namespace Model;

class Inter extends \atk4\data\Model {
    public $table = 'inter';
    public $title = 'Inter';

    function init() {
        parent::init();
        $this->hasOne('timeslot_id', new Time());
        $this->hasOne('teacher_id', new Teacher());
    }
}
