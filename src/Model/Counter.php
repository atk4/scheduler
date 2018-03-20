<?php
namespace Model;

class Counter extends \atk4\data\Model {
    public $table = 'counter';

    function init() {
        parent::init();

        $this->addField('counter');
    }
}
