<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Model;

class BookRepository extends BaseRepository
{
	public function getAllBooks()
	{
		return $this->getTable()->order('name ASC');
	}

	public function getBook($id)
	{
		return $this->getTable()->where('id', $id)->limit(1)->fetch();
	}

	public function getAuthorBooks($authorId)
	{
		return $this->getTable()->where('author_id', $authorId)->order('name ASC');
	}
}
