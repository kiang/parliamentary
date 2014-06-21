<?php
class Party extends AppModel {

    var $name = 'Party';

    var $validate = array(

        'name' => array(

            'notEmpty' => array(

                'rule' => 'notEmpty',

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