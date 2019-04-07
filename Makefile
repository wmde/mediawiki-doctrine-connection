.PHONY: ci test phpunit cs stan covers

DEFAULT_GOAL := ci

ci: test cs

test: covers phpunit

cs: phpcs

phpunit:
	./vendor/bin/phpunit

phpcs:
	./vendor/bin/phpcs -p -s

covers:
	./vendor/bin/covers-validator

