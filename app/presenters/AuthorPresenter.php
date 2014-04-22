<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn;

use Nette\Application\UI\Form;

class AuthorPresenter extends BasePresenter
{
	/** @var \Learn\Model\AuthorRepository @inject */
	public $authorRepository;

	/** @var \Learn\Model\BookRepository @inject */
	public $bookRepository;

	public function renderCreate()
	{
		if(!$this->user->isAllowed('author', 'edit')) {
			$this->flashError('Go away!');
			$this->redirect('Homepage:default');
		}
	}

	public function renderDefault()
	{
		if(!$this->user->isAllowed('author', 'view')) {
			$this->flashError('Go away!');
			$this->redirect('Homepage:default');
		}
		$this->template->authors = $this->authorRepository->getAllAuthors();
	}

	public function renderDetail($id)
	{
		if(!$this->user->isAllowed('author', 'view')) {
			$this->flashError('Go away!');
			$this->redirect('Homepage:default');
		}
		if(!$this->template->author = $author = $this->authorRepository->getAuthor($id)) {
			$this->flashMessage("Author doesn't exist.", 'danger');
			$this->redirect("Author:default");
		}
		$this->template->books = $this->bookRepository->getAuthorBooks($author->id);
	}

	protected function createComponentCreateAuthorForm()
	{
		$form = new Form();
		$form->addText('name', 'Name');
		$form->addText('nation', 'Nation');
		$form->addSubmit('create', 'Create');
		$form->onSuccess[] = $this->createAuthorFormSuccess;
		return $form;
	}

	public function createAuthorFormSuccess(Form $form)
	{
		$this->authorRepository->createAuthor($form->getValues());
		$this->flashSuccess("Author created.");
		$this->redirect('default');
	}
}
