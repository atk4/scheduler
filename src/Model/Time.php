<?php
namespace Model;

class Time extends \atk4\data\Model {
    public $table = 'timeslot';
    public $title = 'Время';
    public $name = 'time';

    function init() {
        parent::init();

        $this->addField('is_available',['type'=>'boolean']);
        $this->addField('name',[
          //'type'=>'time',
          'caption'=>'Time']);

        //$this->hasMany('Inter');


        $this->hasOne('teacher_id', new Teacher())
            ->addTitle();

        $this->getElement('teacher_id')->ui['visible'] = false;

        $this->hasOne('vecaki_id', new Vecaki())
            ->addTitle();

        $this->getElement('vecaki_id')->ui['visible'] = false;
    }
}
