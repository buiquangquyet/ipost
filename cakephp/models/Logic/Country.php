<?php
/**
 * Operation with DB
 */

App::uses('AppModel', 'Model');

class Country extends AppModel
{
    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        ),
        'status' => array(
            'rule' => 'notEmpty'
        )
    );
}