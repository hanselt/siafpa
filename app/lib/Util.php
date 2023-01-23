<?php
 
class Util
{
 
	//creamos un array para guardar ids
	private static $ids = array();
 
	//método para obtener a un usuario por su id
	public static function getUser($id)
	{
 
		return 'Ejemplo get User';
 
	}
 
	//devolvemos las ids de los usuarios separadas con , ej(1,2,3) etc
	public static function implodeUsers($users = array())
	{
		//le pasamos unos nombres que existan en la base de datos al método getIds
		$getIds = self::getIds($users);
		//en el array $ids metemos las ids de los usuarios
		foreach ($getIds as $id)
		{
			self::$ids[] = $id->id;
		}
		//devolvemos las ids
		return implode(",", self::$ids);
 
	}
 
	//método estático privado para obtener usuarios a través de su id
	private static function getIds($groupUsers = array())
	{
 
		return DB::table("users")->whereIn("username",$groupUsers)->get();
 
	}
}