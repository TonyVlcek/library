<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Model;

use Nette\Database\Context;

class AuthorRepository extends BaseRepository
{
	public function getAllAuthors()
	{
		return $this->getTable()->order('name ASC');
	}

	public function getAuthor($id)
	{
		return $this->getTable()->where('id', $id)->limit(1)->fetch();
	}
}
