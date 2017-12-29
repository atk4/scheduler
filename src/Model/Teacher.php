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

        $this->hasOne('subject_id', new Subject())
            ->addTitle();

        $this->getElement('subject_id')->ui['visible'] = false;

        $this->hasMany('Vecaki', new Vecaki);

        //$this->hasMany('Inter');
    }
}
