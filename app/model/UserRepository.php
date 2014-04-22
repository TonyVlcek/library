<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Model;

use Learn\Security\Passwords;
use Nette\ArrayHash;
use Nette\Security\AuthenticationException;
use Nette\Utils\Strings;

class UserRepository extends BaseRepository
{
	public function getUserByName($nick)
	{
		return $this->getTable()->where('name', $nick)->limit(1)->fetch();
	}

	public function registerUser(ArrayHash $values)
	{
		if($this->getUserByName($values->name)) {
			throw new AuthenticationException("User '{$values->name}' already exists.");
		}

		$values->role = 'member';
		$values->salt = Strings::random(5, 'a-zA-Z0-9');
		$values->password = Passwords::hashPassword($values->password, $values->name, $values->salt);
		$this->getTable()->insert($values);
	}
}
