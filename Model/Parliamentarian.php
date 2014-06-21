<?php

class Parliamentarian extends AppModel {

    var $name = 'Parliamentarian';
    var $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'This field is required',
            ),
        ),
        'ad' => array(
            'numberFormat' => array(
                'rule' => 'numeric',
                'message' => 'Wrong format',
                'allowEmpty' => true,
            ),
        ),
    );
    var $actsAs = array(
    );
    var $belongsTo = array(
        'Party' => array(
            'foreignKey' => 'Party_id',
            'className' => 'Party',
        ),
    );
    var $hasAndBelongsToMany = array(
        'Motion' => array(
            'joinTable' => 'motions_parliamentarians',
            'foreignKey' => 'Parliamentarian_id',
            'associationForeignKey' => 'Motion_id',
            'className' => 'Motion',
        ),
    );

    function afterSave($created, $options = array()) {
        
    }

}
