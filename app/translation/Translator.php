<?php
/**
 * @author Tomáš Blatný
 */

use Nette\Localization\ITranslator;

class Translator implements ITranslator
{

	protected $data;

	public function __construct()
	{
		$this->data = parse_ini_file(__DIR__.'/translations.ini');
	}

	public function translate($message, $count = NULL)
	{
		return isset($this->data[$message]) ? $this->data[$message] : $message;
	}
}
