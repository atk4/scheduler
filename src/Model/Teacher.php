<?php
namespace Model;

class Teacher extends \atk4\data\Model {
    public $table = 'teacher';
    public $title = 'Учитель';
    public $name = 'Учитель';

    function init() {
        parent::init();

        $this->addField('name');
        $this->addField('contact_phone');
        $this->addField('nick_name');
        $this->addField('password',['type'=>'password']);

        $this->hasOne('subject_id', new Subject())
            ->addTitle();

        $this->getElement('subject_id')->ui['visible'] = true;

        $this->hasMany('Day');
    }
}
