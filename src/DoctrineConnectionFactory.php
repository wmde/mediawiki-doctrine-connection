<?php

namespace MediaWiki\DoctrineConnection;

use Closure;
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
		return new Connection(
			[],
			new MysqliDriver( $this->getWrappedConnection( $db ) )
		);
	}

	private function newSqliteBasedConnection( DatabaseSqlite $db ): Connection {
		return DriverManager::getConnection( [ 'pdo' => $this->getWrappedConnection( $db ) ] );
	}

	private function getWrappedConnection( $db ) {
		$getConnection = Closure::bind(
			function( $db ) {
				return $db->conn;
			},
			null,
			$db
		);

		return $getConnection( $db );
	}

}
