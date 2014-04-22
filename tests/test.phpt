<?php
require __DIR__."/bootstrap.php";

use Tester\Assert;

function getA() {
	return 'a';
}

Assert::equal('a', getA());
