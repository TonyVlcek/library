<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Security;

use Nette\Object;

class Passwords extends Object
{
	public static function hashPassword($password, $username, $salt)
	{
		return self::mutliHash($username . '@' . $password, $salt, 5, 'sha512');
	}

	protected static function mutliHash($password, $salt, $count = 1, $hashType = 'md5')
	{
		$hashed = self::hash($password, $salt, $hashType);
		return $count <= 1 ? $hashed : self::mutliHash($hashed, $salt, --$count, $hashType);
	}

	protected static function hash($password, $salt, $hashType = 'md5')
	{
		return hash($hashType, $salt . $password . $salt);
	}
}
