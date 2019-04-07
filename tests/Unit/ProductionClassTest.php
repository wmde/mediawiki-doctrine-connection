<?php

declare( strict_types = 1 );

namespace MediaWiki\DoctrineConnection\Tests\Unit;

use PHPUnit\Framework\TestCase;
use MediaWiki\DoctrineConnection\ProductionClass;

/**
 * @covers \MediaWiki\DoctrineConnection\ProductionClass
 */
class ProductionClassTest extends TestCase {

	public function testGetTrue() {
		$this->assertTrue( ProductionClass::getTrue() );
	}

}
