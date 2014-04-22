<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn;

class AuthorPresenter extends BasePresenter
{
	/** @var \Learn\Model\AuthorRepository @inject */
	public $authorRepository;

	public function renderDefault()
	{
		$this->template->authors = $this->authorRepository->getAllAuthors();
	}
}
