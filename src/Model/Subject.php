<?php
namespace Model;

class Subject extends \atk4\data\Model {
    public $table = 'subject';
    public $title = 'Stunda';

    function init() {
        parent::init();

        $this->addField('name',['caption'=>'Stunda']);

        $this->hasMany('Teacher', new Teacher);
    }
}
