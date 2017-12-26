<?php
namespace Model;

class Day extends \atk4\data\Model {
    public $table = 'Day';
    public $title = 'День';

    function init() {
        parent::init();
        $this->addField('name');
        $this->getElement('name')->ui['visible'] = false;

        $this->addField('date',['type'=>'date']);

        $this->hasOne('teacher_id', new Teacher())
            ->addTitle();

        $this->getElement('teacher_id')->ui['visible'] = false;
        $this->hasMany('Time',new Time);
    }
}
