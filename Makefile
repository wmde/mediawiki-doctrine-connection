.PHONY: ci test phpunit cs stan covers

DEFAULT_GOAL := cs

cs: phpcs

phpcs:
	./vendor/bin/phpcs -p -s

covers:
	./vendor/bin/covers-validator

