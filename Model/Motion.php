<?php

class Motion extends AppModel {

    var $name = 'Motion';
    var $actsAs = array(
    );
    var $hasAndBelongsToMany = array(
        'Area' => array(
            'joinTable' => 'areas_motions',
            'foreignKey' => 'Motion_id',
            'associationForeignKey' => 'Area_id',
            'className' => 'Area',
        ),
        'Parliamentarian' => array(
            'joinTable' => 'motions_parliamentarians',
            'foreignKey' => 'Motion_id',
            'associationForeignKey' => 'Parliamentarian_id',
            'className' => 'Parliamentarian',
        ),
    );

}
