<?php

/**
 * Test: Nette\DI\Compiler and ExtensionsExtension.
 */

use Nette\DI,
	Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class FooExtension extends DI\CompilerExtension
{
	function loadConfiguration()
	{
		$this->getContainerBuilder()->parameters['foo'] = 'hello';
	}
}


$compiler = new DI\Compiler;
$compiler->addExtension('extensions', new Nette\DI\Extensions\ExtensionsExtension);
$container = createContainer($compiler, '
extensions:
	foo: FooExtension

foo:
	key: value
');


Assert::same( 'hello', $container->parameters['foo'] );
