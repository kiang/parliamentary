<?php

class Grant extends AppModel {

    var $name = 'Grant';
    var $hasAndBelongsToMany = array(
        'Area' => array(
            'joinTable' => 'areas_grants',
            'foreignKey' => 'Grant_id',
            'associationForeignKey' => 'Area_id',
            'className' => 'Area',
        ),
        'Parliamentarian' => array(
            'joinTable' => 'grants_parliamentarians',
            'foreignKey' => 'Grant_id',
            'associationForeignKey' => 'Parliamentarian_id',
            'className' => 'Parliamentarian',
        ),
    );

}
