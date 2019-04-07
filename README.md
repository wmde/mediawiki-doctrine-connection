# MediaWiki Doctrine Connection

[![Build Status](https://travis-ci.org/wmde/mediawiki-doctrine-connection.svg?branch=master)](https://travis-ci.org/wmde/mediawiki-doctrine-connection)

Tiny library for creating a Doctrine DBAL Connection from a MediaWiki Database object.

## Usage

TODO

## Installation

To use the MediaWiki Doctrine Connection library in your project, simply add a dependency on mediawiki/doctrine-connection
to your project's `composer.json` file. Here is a minimal example of a `composer.json`
file that just defines a dependency on MediaWiki Doctrine Connection 1.x:

```json
{
    "require": {
        "mediawiki/doctrine-connection": "~1.0"
    }
}
```

## Development

Start by installing the project dependencies by executing

    composer update

You can run the style checks by executing

    make cs
    
Since the library depends on MediaWiki, you need to have a working MediaWiki
installation to run the tests. You need these two steps to run the tests:

* Load `vendor/autoload.php` of this library in your MediaWiki's `LocalSettings.php` file
* Execute `maintenance/phpunit.php -c /path/to/this/lib/phpunit.xml.dist`

For an example see the TravisCI setup (`.travis.yml` and `.travis.install.sh`)