<?php
namespace Model;

class Parents extends \atk4\data\Model {
    public $table = 'parent';

    function init() {
        parent::init();

        $this->addField('parent_name');
        $this->addField('parent_phone');
        $this->addField('student_name');
        $this->hasOne('timeslot_id', new Timeslot);
    }
}
