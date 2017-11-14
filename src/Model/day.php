<?php
namespace Model;

class Day extends \atk4\data\Model {
    public $table = 'day';
    public $title = 'День';

    function init() {
        parent::init();
        $this->addField('date');
        $this->hasOne('teacher_id', new Teacher());
        $this->hasMany('timeslot_id',new Timeslot());
    }
}
