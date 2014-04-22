<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Security;

use Learn\Model\UserRepository;
use Nette\Object;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Identity;

class Authenticator extends Object implements IAuthenticator
{
	/** @var \Learn\Model\UserRepository */
	protected $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		if(!$user = $this->userRepository->getUserByName($username)) {
			throw new AuthenticationException("User $username not found.");
		}

		if($user->password !== Passwords::hashPassword($password, $username, $user->salt)) {
			throw new AuthenticationException("Invalid password.");
		}

		return new Identity($user->id, $user->role, $user);
	}
}
