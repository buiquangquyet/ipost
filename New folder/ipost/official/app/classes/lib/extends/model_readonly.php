<?php
/**
 * View参照専用ベースModelクラス（※Fuel\Core\Model_Crud拡張クラス）
 *
 * @author     K.ITAHANA
 *
 * ・DBのViewを参照することを目的とする
 * ・Fuel\Core\Model_Crudの更新系メソッドを封印
 */


class Model_Readonly extends \Fuel\Core\Model_Crud
{

	/**
	 * Saves the object to the database by either creating a new record
	 * or updating an existing record. Sets the default values if set.
	 *
	 * @param   bool   $validate  wether to validate the input
	 * @return  mixed  Rows affected and or insert ID
	 */
	public function save($validate = true)
	{
	    throw new Exception(__CLASS__.' is readonly model.');
    }

	/**
	 * Deletes this record and freezes the object
	 *
	 * @return  mixed  Rows affected
	 */
	public function delete()
	{
	    throw new Exception(__CLASS__.' is readonly model.');
	}

}
