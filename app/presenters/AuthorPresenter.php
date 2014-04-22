<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn;

class AuthorPresenter extends BasePresenter
{
	/** @var \Learn\Model\AuthorRepository @inject */
	public $authorRepository;

	/** @var \Learn\Model\BookRepository @inject */
	public $bookRepository;

	public function renderDefault()
	{
		$this->template->authors = $this->authorRepository->getAllAuthors();
	}

	public function renderDetail($id)
	{
		if(!$this->template->author = $author = $this->authorRepository->getAuthor($id)) {
			$this->flashMessage("Author doesn't exist.", 'danger');
			$this->redirect("Author:default");
		}
		$this->template->books = $this->bookRepository->getAuthorBooks($author->id);
	}
}
