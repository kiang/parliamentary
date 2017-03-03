<?php

class Party extends AppModel {

    var $name = 'Party';
    var $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'This field is required',
            ),
        ),
    );
    var $actsAs = array(
    );
    var $hasMany = array(
        'Parliamentarian' => array(
            'foreignKey' => 'Party_id',
            'dependent' => false,
            'className' => 'Parliamentarian',
        ),
    );

    function afterSave($created, $options = array()) {
        
    }

}
