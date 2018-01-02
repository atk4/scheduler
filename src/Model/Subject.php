<?php
namespace Model;

class Subject extends \atk4\data\Model {
    public $table = 'subject';
    public $title = 'Урок';

    function init() {
        parent::init();

        $this->addField('name');

        $this->hasMany('Teacher');
    }
}
