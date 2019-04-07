<?php

declare( strict_types = 1 );

namespace MediaWiki\DoctrineConnection\Tests\Unit;

use Doctrine\DBAL\Connection;
use MediaWiki\DoctrineConnection\DoctrineConnectionFactory;

/**
 * @covers \MediaWiki\DoctrineConnection\DoctrineConnectionFactory
 */
class DoctrineConnectionFactoryTest extends \MediaWikiTestCase {

	public function testGetTrue() {
		$this->assertInstanceOf(
			Connection::class,
			( new DoctrineConnectionFactory() )->connectionFromDatabase( $this->db )
		);
	}

}
