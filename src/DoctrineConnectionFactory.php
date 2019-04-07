<?php

namespace MediaWiki\DoctrineConnection;

use Doctrine\DBAL\Connection;
use MediaWiki\DoctrineConnection\PackagePrivate\MysqliDriver;
use Wikimedia\Rdbms\Database;
use Wikimedia\Rdbms\DatabaseMysqli;

class DoctrineConnectionFactory {

	public function connectionFromDatabase( Database $db ) {
		if ( $db instanceof DatabaseMysqli ) {
			$reflectionProperty = new \ReflectionProperty( DatabaseMysqli::class, 'conn' );
			$reflectionProperty->setAccessible( true );

			return new Connection(
				[],
				new MysqliDriver( $reflectionProperty->getValue( $db ) )
			);
		}

	}

}
