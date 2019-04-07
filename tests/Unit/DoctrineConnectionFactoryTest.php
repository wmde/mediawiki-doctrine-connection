<?php

declare( strict_types = 1 );

namespace MediaWiki\DoctrineConnection\Tests\Unit;

use DatabaseTestHelper;
use Doctrine\DBAL\Connection;
use MediaWiki\DoctrineConnection\DoctrineConnectionFactory;
use Wikimedia\Rdbms\Database;
use Wikimedia\Rdbms\DatabaseSqlite;

/**
 * @covers \MediaWiki\DoctrineConnection\DoctrineConnectionFactory
 */
class DoctrineConnectionFactoryTest extends \MediaWikiTestCase {

	public function testMainDatabase() {
		$this->assertCanTurnDatabaseIntoConnection( $this->db );
	}

	private function assertCanTurnDatabaseIntoConnection( Database $db ) {
		$connection = ( new DoctrineConnectionFactory() )->connectionFromDatabase( $db );

		$this->assertInstanceOf(
			Connection::class,
			$connection
		);

		// TODO: assert functioning
	}

	public function testSqliteDatabase() {
		$this->assertCanTurnDatabaseIntoConnection(
			DatabaseSqlite::newStandaloneInstance( ':memory:' )
		);
	}

	public function testGivenUnsupportedDatabase_exceptionIsThrown() {
		$unsupportedDb = new DatabaseTestHelper( 'test' );

		$this->expectException( \RuntimeException::class );
		( new DoctrineConnectionFactory() )->connectionFromDatabase( $unsupportedDb );
	}

}
