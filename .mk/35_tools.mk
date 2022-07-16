## PHPCS

.PHONY: phpcs
phpcs: ## PHP-CS-Fixer: Tools homepage
	$(PHP_CS_FIXER)

.PHONY: phpcs.show
phpcs.show: ## PHP-CS-Fixer: Run and show console
	$(PHP_CS_FIXER) fix --dry-run

.PHONY: phpcs.fix
phpcs.fix: ## PHP-CS-Fixer: Run and fix
	$(PHP_CS_FIXER) fix

## SH

.PHONY: node.sh
node.sh: ## Node: App sh access by node container
	$(EXEC_APP_NODE) sh

.PHONY: node.sh.force
node.sh.force: ## Node: App sh access by node container not running
	$(RUN) --rm $(SERVICE_NODE) sh

.PHONY: php.sh
php.sh: ## Php: App sh access by php container
	$(EXEC_APP_PHP) sh

.PHONY: php.sh.force
php.sh.force: ## Node: App sh access by php container not running
	$(RUN) --rm $(SERVICE_PHP) sh
