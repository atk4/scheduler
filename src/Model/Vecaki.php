<?php
namespace Model;

class Vecaki extends \atk4\data\Model {
    public $table = 'vecaki';
    public $title = 'Родитель';
    public $name = 'nick_name';
    public $title_field = 'parent_name';

    function init() {
        parent::init();

        $this->addField('student_name');
        $this->addField('parent_name');
        $this->addField('contact_phone');
        $this->addField('nick_name');
        $this->addField('password',['type'=>'password']);
        $this->hasMany('time');
    }
}
