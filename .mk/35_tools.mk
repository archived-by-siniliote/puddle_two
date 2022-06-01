## PHPUNIT

.PHONY: phpcs
phpcs: ## PHP-CS-Fixer: Tools homepage
	$(PHP_CS_FIXER)

.PHONY: phpcs.show
phpcs.show: ## PHP-CS-Fixer: Run and show console
	$(PHP_CS_FIXER) fix --dry-run --config ./tools/php-cs-fixer/.php-cs-fixer.dist.php
