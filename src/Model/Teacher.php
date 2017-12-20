<?php
namespace Model;

class Teacher extends \atk4\data\Model {
    public $table = 'teacher';
    public $title = 'Учитель';

    function init() {
        parent::init();

        $this->addField('name');
        $this->addField('phone');

        $this->hasOne('subject_id', new Subject())
            ->addTitle();
        $this->getElement('subject_id')->ui['visible'] = false;
        $this->hasMany('Inter',new Inter());
    }
}
