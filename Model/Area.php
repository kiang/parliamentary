<?php

App::uses('AppModel', 'Model');

/**
 * Area Model
 *
 */
class Area extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $actsAs = array('Tree');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'parent_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    public $hasMany = array(
        'AreasMotion' => array(
            'foreignKey' => 'Area_id',
            'dependent' => false,
            'className' => 'AreasMotion',
        ),
    );
    public $hasAndBelongsToMany = array(
        'Parliamentarian' => array(
            'joinTable' => 'areas_parliamentarians',
            'foreignKey' => 'Area_id',
            'associationForeignKey' => 'Parliamentarian_id',
            'className' => 'Parliamentarian',
        ),
    );

    function getParents($areaId) {
        $parents = $this->getPath($areaId, array('id', 'name'));
        $parents = array_merge(array(0 => array(
                'Area' => array(
                    'id' => 0,
                    'name' => '全部',
                ))), $parents);
        return $parents;
    }

}
