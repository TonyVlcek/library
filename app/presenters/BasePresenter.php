<?php

namespace Learn;

use Nette\Application\UI\Presenter;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Presenter
{
	public function refresh()
	{
		$this->redirect('this');
	}

	public function flashSuccess($message)
	{
		return $this->flashMessage($message, 'success');
	}

	public function flashError($message)
	{
		return $this->flashMessage($message, 'danger');
	}

	public function handleLogout()
	{
		$this->user->logout();
		$this->flashSuccess('Logout successful.');
		$this->refresh();
	}
}
