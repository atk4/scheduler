<?php
namespace Model;

class Vecaki extends \atk4\data\Model {
    public $table = 'vecaki';
    public $title = 'Родитель';
    public $name = 'parent_name';
    public $title_field = 'parent_name';

    function init() {
        parent::init();

        $this->addField('student_name');
        $this->addField('parent_name');
        $this->addField('contact_phone');
        $this->addField('time');
        $this->hasOne('teacher_id', new Teacher)->addTitle();

    }
}
