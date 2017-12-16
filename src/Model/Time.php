<?php
namespace Model;

class Time extends \atk4\data\Model {
    public $table = 'timeslot';
    public $title = 'Время';
    public $name = 'time';

    function init() {
        parent::init();

        $this->addField('is_available',['type'=>'boolean']);
        $this->addField('time',['type'=>'time']);

        $this->hasMany('Inter');


        $this->hasOne('vecaki_id', new Vecaki())
            ->addTitle();

        $this->getElement('vecaki_id')->ui['visible'] = false;
    }
}
