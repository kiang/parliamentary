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
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
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