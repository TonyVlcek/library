<?php
/**
 * @author Tomáš Blatný
 */

namespace Learn\Model;

use Nette\Database\Context;
use Nette\Object;

abstract class BaseRepository extends Object
{
	/** @var \Nette\Database\Context */
	protected $context;

	/** @var string */
	protected $table;

	/**
	 * @param Context $context
	 * @param string  $table
	 */
	public function __construct(Context $context, $table)
	{
		$this->context = $context;
		$this->table = $table;
	}

	protected function getTable()
	{
		return $this->context->table($this->table);
	}
}
