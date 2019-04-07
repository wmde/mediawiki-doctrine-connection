<?php

namespace MediaWiki\DoctrineConnection\PackagePrivate;

use Doctrine\DBAL\Driver\AbstractMySQLDriver;
use mysqli;

class MysqliDriver extends AbstractMySQLDriver {

	private $conn;

	public function __construct( mysqli $conn ) {
		$this->conn = $conn;
	}

	public function connect( array $params, $username = null, $password = null, array $driverOptions = [] ) {
		return new DriverConnection( $this->conn );
	}

	public function getName() {
		return 'MW-mysqli';
	}

}
