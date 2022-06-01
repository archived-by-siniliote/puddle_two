## PHPUNIT

.PHONY: phpunit
phpunit: xdebug.off ## PHPUnit: Launch all tests (unit, functional, ...).
	$(PHPUNIT)

.PHONY: phpunit.coverage
phpunit.coverage: xdebug.on _build ## PHPUnit: Generate code clover in HTML format | Clover style coverage report | Junit and xml-coverage for Infection.
	$(PHPUNIT) --coverage-html=$(PHPUNIT_COVERAGE) --coverage-xml=$(PROJECT_BUILD)/phpunit/coverage-xml --log-junit=$(PROJECT_BUILD)/logs/junit.xml --coverage-clover=$(PROJECT_BUILD)/logs/clover.xml

.PHONY: phpunit.coverage.open
phpunit.coverage.open: ## PHPUnit: Open code coverage report.
	gio open $(PROJECT_ROOT)/$(PHPUNIT_COVERAGE)/index.html

##

.PHONY: phpunit.unit
phpunit.unit: ## PHPUnit: Launch unit tests.
	$(PHPUNIT) --testsuite unit

.PHONY: phpunit.unit.coverage
phpunit.unit.coverage: xdebug.on _build ## PHPUnit: Generate code coverage report in HTML format for unit tests.
	$(PHPUNIT) --testsuite unit --coverage-html=$(PHPUNIT_COVERAGE)

.PHONY: phpunit.functional
phpunit.functional: xdebug.off ## PHPUnit: Launch functional tests.
	$(PHPUNIT) --testsuite functional

.PHONY: phpunit.functional.coverage
phpunit.functional.coverage: xdebug.on _build ## PHPUnit: Generate code coverage report in HTML format for functional tests.
	$(PHPUNIT) --testsuite functional --coverage-html=$(PHPUNIT_COVERAGE)
