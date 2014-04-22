<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Model;

use Nette\Database\Context;

class AuthorRepository extends BaseRepository
{
	public function __construct(Context $context)
	{
		parent::__construct($context, 'author');
	}

	public function getAllAuthors()
	{
		return $this->getTable()->order('name ASC');
	}

	public function getAuthor($id)
	{
		return $this->getTable()->where('id', $id)->limit(1)->fetch();
	}
}
