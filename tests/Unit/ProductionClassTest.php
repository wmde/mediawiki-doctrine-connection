<?php

declare( strict_types = 1 );

namespace MediaWiki\DoctrineConnection\Tests\Unit;

use PHPUnit\Framework\TestCase;

class ProductionClassTest extends TestCase {

	public function testGetTrue() {
		$this->assertTrue( true );
	}

}
