## MAKEFILE

SUPPORTS_MAKE_ARGS := $(findstring $(firstword $(MAKECMDGOALS)), $(SUPPORTED_COMMANDS))
ifneq "$(SUPPORTS_MAKE_ARGS)" ""
  COMMAND_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  COMMAND_ARGS := $(subst :,\:,$(COMMAND_ARGS))
  $(eval $(COMMAND_ARGS):;@:)
endif

ifeq ($J,)

ifeq ($(OS),Linux)
  NPROCS := $(shell grep -c ^processor /proc/cpuinfo)
else ifeq ($(OS),Darwin)
#   NPROCS := $(shell system_profiler | awk '/Number of CPUs/ {print $$4}{next;}') 
#  OR
#   NPROCS := $(sysctl -n hw.ncpu)
endif # $(OS)

else
  NPROCS := $J
endif # $J

.DEFAULT_GOAL := help
.PHONY: help
help: ## Makefile: Print self-documented Makefile.
	@grep -E '(^[[:alpha:]]+[^:]+:.*##.*?$$)|(^#{2})' $(MAKEFILE_LIST) \
	| awk 'BEGIN {FS = "## "}; \
		{ \
			split($$1, command, ":"); \
			target=command[2]; \
			description=$$2; \
			# --- space --- \
			if (target=="##") \
				printf "\033[33m%s\n", ""; \
			# --- title --- \
			else if (target=="" && description!="") \
				printf "\033[33m\n%s\n", description; \
			# --- command + description --- \
			else if (target!="" && description!="") \
				printf "\033[32m  %-30s \033[0m%s\n", target, description; \
			# --- do nothing --- \
			else \
				; \
		}'

.PHONY: list
list: $(sort $(wildcard $(MAKEFILES))) ## Makefile: List all included files.
	@printf '%s\n' $^