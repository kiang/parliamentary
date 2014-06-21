<?php

class Motion extends AppModel {

    var $name = 'Motion';
    var $actsAs = array(
    );
    var $hasAndBelongsToMany = array(
        'Parliamentarian' => array(
            'joinTable' => 'motions_parliamentarians',
            'foreignKey' => 'Motion_id',
            'associationForeignKey' => 'Parliamentarian_id',
            'className' => 'Parliamentarian',
        ),
    );

    function afterSave($created, $options = array()) {
        
    }

}
