<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use PDO;

class MyUser
{
	private string $_login;
	private ?string $_password;

	private const USER_TABLE = "myusers";

	public function __construct( string $login, string $password = null )
	{
		$this->setLogin($login);
		$this->setPassword($password);
	}

	public function login() : string
	{
		return $this->_login;
	}

	public function setLogin( string $login ) : void
	{
		$this->_login = $login;
	}

	public function password() : string
	{
		return $this->_password;
	}

	public function setPassword( ?string $password ) : void
	{
		$this->_password = $password;
	}

	public function exists() : bool
	{
		$request = DB::connection()->getPdo()->prepare('SELECT password FROM '.self::USER_TABLE.' WHERE login = :login');
		$ok = $request->bindValue( ":login", $this->_login, PDO::PARAM_STR );
		$ok &= $request->execute();

		if (!$ok) 
			throw new \Exception("Error: user access in DB failed.");

		$user = $request->fetch(PDO::FETCH_ASSOC);
		
		return $user && password_verify($this->_password,$user['password']);
	}

	public function create() : void
	{
		$request = DB::connection()->getPdo()->prepare('INSERT INTO '.self::USER_TABLE.'(login,password) VALUES (:login,:password)');
		$ok =  $request->bindValue( ":login", $this->_login, PDO::PARAM_STR );
		$ok &= $request->bindValue( ":password", password_hash($this->_password,PASSWORD_DEFAULT), PDO::PARAM_STR );
		$ok &= $request->execute();

		if ( !$ok )
			throw new \Exception("Error: user creation in DB failed.");
	}

	public function changePassword( string $newpassword ) : void
	{
		$request = DB::connection()->getPdo()->prepare('UPDATE '.self::USER_TABLE.' SET password = :password WHERE login = :login');
		$ok =  $request->bindValue(':login',    $this->_login, PDO::PARAM_STR);
		$ok &= $request->bindValue(':password', password_hash($newpassword,PASSWORD_DEFAULT), PDO::PARAM_STR);
		$ok &= $request->execute();

		if ( !$ok )
			throw new \Exception("Error: password updating failed.");

		$this->setPassword($newpassword);
	}

	public function delete() : void
	{
		$request = DB::connection()->getPdo()->prepare('DELETE FROM '.self::USER_TABLE.' WHERE login = :login');
		$ok =  $request->bindValue(':login', $this->_login, PDO::PARAM_STR);
		$ok &= $request->execute();

		if ( !$ok )
			throw new \Exception("Error while deleting your account.");
	}

	public function loginExists(): bool
	{
		$request = DB::connection()->getPdo()->prepare('SELECT COUNT(*) FROM '.self::USER_TABLE.' WHERE login = :login');
		$ok = $request->bindValue(":login", $this->_login, PDO::PARAM_STR);
		$ok &= $request->execute();

		if (!$ok) {
			throw new \Exception("Error: login check failed.");
		}

		$count = $request->fetchColumn();
		return $count > 0;
	}

}
