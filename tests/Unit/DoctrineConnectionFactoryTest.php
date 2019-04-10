<?php

namespace MediaWiki\DoctrineConnection\Tests\Unit;

use DatabaseTestHelper;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Type;
use MediaWiki\DoctrineConnection\DoctrineConnectionFactory;
use MediaWikiTestCase;
use RuntimeException;
use Wikimedia\Rdbms\Database;
use Wikimedia\Rdbms\DatabaseSqlite;

/**
 * @covers \MediaWiki\DoctrineConnection\DoctrineConnectionFactory
 */
class DoctrineConnectionFactoryTest extends MediaWikiTestCase {

	public function testMainDatabase() {
		$this->assertCanTurnDatabaseIntoConnection( $this->db );
	}

	private function assertCanTurnDatabaseIntoConnection( Database $db ) {
		$connection = ( new DoctrineConnectionFactory() )->connectionFromDatabase( $db );

		$this->assertInstanceOf(
			Connection::class,
			$connection
		);

		$this->assertConnectionFunctionsProperly( $connection );
	}

	private function assertConnectionFunctionsProperly( Connection $connection ) {
		$table = new Table(
			'kittens',
			[
				new Column( 'id', Type::getType( Type::INTEGER ), [ 'autoincrement' => true ] ),
				new Column( 'name', Type::getType( Type::STRING ), [ 'length' => 255 ] ),
			]
		);

		$table->setPrimaryKey( [ 'id' ] );

		$connection->getSchemaManager()->createTable( $table );

		$connection->insert( 'kittens', [ 'name' => 'maru' ] );

		$this->assertEquals(
			[ 'id' => 1, 'name' => 'maru' ],
			$connection->executeQuery( 'SELECT * FROM kittens' )->fetch()
		);
	}

	public function testSqliteDatabase() {
		$this->assertCanTurnDatabaseIntoConnection(
			DatabaseSqlite::newStandaloneInstance( ':memory:' )
		);
	}

	public function testGivenUnsupportedDatabase_exceptionIsThrown() {
		$unsupportedDb = new DatabaseTestHelper( 'test' );

		$this->expectException( RuntimeException::class );
		( new DoctrineConnectionFactory() )->connectionFromDatabase( $unsupportedDb );
	}

}
