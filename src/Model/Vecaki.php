<?php
namespace Model;

class Vecaki extends \atk4\data\Model {
    public $table = 'vecaki';
    public $title = 'Vecaki';
    public $name = 'parent_name';
    public $title_field = 'parent_name';

    function init() {
        parent::init();

        $this->addField('student_name',['caption'=>'Skolnieka vards un uzvards','required'=>TRUE]);
        $this->addField('grade',['caption'=>'Klase','required'=>TRUE]);
        $this->addField('parent_name',['caption'=>'Vecaku vārds un uzvārds','required'=>TRUE]);
        $this->addField('contact_phone',['caption'=>'Kontaktnumurs','required'=>TRUE]);
        $this->addField('time',['caption'=>'Laiks']);
        $this->hasOne('teacher_id', new Teacher)->addTitle();
        $this->setOrder('time');

    }
}
