<?php

class Term extends AppModel {

    var $name = 'Term';
    var $hasAndBelongsToMany = array(
        'Motion' => array(
            'joinTable' => 'motions_terms',
            'foreignKey' => 'Term_id',
            'associationForeignKey' => 'Motion_id',
            'className' => 'Motion',
        ),
    );

}
