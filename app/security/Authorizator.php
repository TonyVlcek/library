<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Security;

use Nette\Security\Permission;

class Authorizator extends Permission
{
	public function __construct()
	{
		$this->addRole('member');
		$this->addRole('admin', 'member');
		$this->addRole('owner');

		$this->addResource('author');
		$this->addResource('book');

		$this->allow('member', array('author', 'book'), 'view');
		$this->allow('admin', array('author', 'book'), 'edit');

		$this->allow('owner');
	}
}
