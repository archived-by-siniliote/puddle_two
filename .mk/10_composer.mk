## COMPOSER

SUPPORTED_COMMANDS += composer.require composer.require.dev

.PHONY: composer.install
composer.install: ## Composer: Read the composer.json/composer.lock file from the current directory, resolve the dependencies, and install them into vendor.
	@echo -e "\033[1;43mComposer: Install\033[0m"
	$(COMPOSER) install --verbose

.PHONY: composer.install.prod
composer.install.prod: ## Composer: Idem `composer.install` without dev elements.
	@echo -e "\033[1;43mComposer: Install PROD\033[0m"
	$(COMPOSER) install --verbose --no-progress --no-interaction --prefer-dist --optimize-autoloader --no-dev

.PHONY: composer.require
composer.require: ## Composer: Require vendor in args
	@echo -e "\033[1;43mComposer: Require vendor $(COMMAND_ARGS)\033[0m"
	$(COMPOSER) require --verbose --no-progress --prefer-dist --optimize-autoloader $(COMMAND_ARGS)

.PHONY: composer.require.dev
composer.require.dev: ## Composer: Require vendor dev in args
	@echo -e "\033[1;43mComposer: Require vendor dev $(COMMAND_ARGS)\033[0m"
	$(COMPOSER) require --dev --verbose --no-progress --prefer-dist --optimize-autoloader $(COMMAND_ARGS)

.PHONY: composer.update
# --lock: only update the lock file hash to suppress warning about the lock file being out of date
# --no-scripts: skip execution of scripts defined in composer.json
# --no-interaction: do not ask any interactive question
# --prefer-dist: install packages from dist when available
composer.update: ## Composer: Get the latest versions of the dependencies and update the composer.lock file.
	@echo -e "\033[1;43mComposer: Update\033[0m"
	$(COMPOSER) update --lock --no-scripts --no-interaction --prefer-dist --verbose

.PHONY: composer.licenses
composer.licenses: ## Composer: List the name, version and license of every package installed.
	$(COMPOSER) licenses

.PHONY: composer.validate
# --no-check-publish: Do not emit an error if composer.json is unsuitable for publishing as a package on Packagist but is otherwise valid.
composer.validate: ## Composer: Check if your composer.json is valid. | https://getcomposer.org/doc/03-cli.md#validate
	docker compose run --no-deps $(SERVICE_APP) composer validate --no-check-publish

.PHONY: composer.dumpenv.prod
composer.dumpenv.prod: ## Composer: Dump .env files for "prod".
	$(COMPOSER) dump-env prod

.PHONY: composer.outdated
composer.outdated: ## Composer: The outdated command shows a list of installed packages that have updates available, including their current and latest versions.
	$(COMPOSER) outdated --verbose
