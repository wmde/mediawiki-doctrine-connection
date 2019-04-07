<?php

namespace MediaWiki\DoctrineConnection;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use MediaWiki\DoctrineConnection\PackagePrivate\MysqliDriver;
use Wikimedia\Rdbms\DatabaseMysqli;
use Wikimedia\Rdbms\DatabaseSqlite;
use Wikimedia\Rdbms\IDatabase;

class DoctrineConnectionFactory {

	public function connectionFromDatabase( IDatabase $db ): Connection {
		if ( $db instanceof DatabaseMysqli ) {
			return $this->newMysqliBasedConnection( $db );
		}

		if ( $db instanceof DatabaseSqlite ) {
			return $this->newSqliteBasedConnection( $db );
		}

		throw new \RuntimeException( 'Unsupported database type' );
	}

	private function newMysqliBasedConnection( DatabaseMysqli $db ): Connection {
		$reflectionProperty = new \ReflectionProperty( DatabaseMysqli::class, 'conn' );
		$reflectionProperty->setAccessible( true );

		return new Connection(
			[],
			new MysqliDriver( $reflectionProperty->getValue( $db ) )
		);
	}

	private function newSqliteBasedConnection( DatabaseSqlite $db ): Connection {
		$reflectionProperty = new \ReflectionProperty( DatabaseSqlite::class, 'conn' );
		$reflectionProperty->setAccessible( true );

		return DriverManager::getConnection( [ 'pdo' => $reflectionProperty->getValue( $db ) ] );
	}

}
