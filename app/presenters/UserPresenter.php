<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn;

use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;

class UserPresenter extends BasePresenter
{
	/** @var \Learn\Model\UserRepository @inject */
	public $userRepository;

	protected function createComponentRegisterForm()
	{
		$form = new Form();
		$form->addText('name', 'Name');
		$form->addPassword('password', 'Password');
		$form->addSubmit('register', 'Register');
		$form->onSuccess[] = $this->registerFormSuccess;
		return $form;
	}

	public function registerFormSuccess(Form $form)
	{
		try {
			$this->userRepository->registerUser($form->getValues());
		} catch(AuthenticationException $e) {
			$this->flashError($e->getMessage());
			$this->refresh();
		}
		$this->flashMessage('Registration successful.');
		$this->refresh();
	}

	protected function createComponentLoginForm()
	{
		$form = new Form();
		$form->addText('name', 'Name');
		$form->addPassword('password', 'Password');
		$form->addSubmit('login', 'Login');
		$form->onSuccess[] = $this->loginFormSuccess;
		return $form;
	}

	public function loginFormSuccess(Form $form)
	{
		$v = $form->getValues();
		try {
			$this->user->login($v->name, $v->password);
			$this->flashSuccess("Login successful.");
			$this->redirect('Homepage:default');
		} catch(AuthenticationException $e) {
			$this->flashError($e->getMessage());
			$this->refresh();
		}
	}
}
