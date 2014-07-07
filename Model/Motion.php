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
        'Term' => array(
            'joinTable' => 'motions_terms',
            'foreignKey' => 'Motion_id',
            'associationForeignKey' => 'Term_id',
            'className' => 'Term',
        ),
    );

}
