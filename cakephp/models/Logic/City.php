<?php
/**
 * Operation with DB
 */

App::uses('AppModel', 'Model');

class City extends AppModel
{

    public $validate = array(
    	'countries_id' => array(
            'rule' => 'notEmpty'
        ),
        'name' => array(
            'rule' => 'notEmpty'
        ),
        'status' => array(
            'rule' => 'notEmpty'
        )
    );
}