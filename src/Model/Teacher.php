<?php
namespace Model;

class Teacher extends \atk4\data\Model {
    public $table = 'teacher';
    public $title = 'Skolotājs';
    public $name = 'Skolotājs';

    function init() {
        parent::init();

        $this->addField('name',['caption'=>'Uzvārds, vārds','required'=>TRUE]);
        $this->addField('cabinet',['caption'=>'Kabinets','required'=>TRUE]);
        $this->addField('available',['caption'=>'Būs','type'=>'boolean','required'=>TRUE]);

        $this->hasOne('subject_id', [new Subject(),'caption'=>'Grupa'])
            ->addTitle();

        $this->getElement('subject_id')->ui['visible'] = false;

        $this->hasMany('Vecāki', new Vecaki);
        $this->setOrder('name');

    }
}
