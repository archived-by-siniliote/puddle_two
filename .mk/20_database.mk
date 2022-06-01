## DATABASE

PHONY: db.create
db.create: doctrine.database.create doctrine.migrations.migrate.nointeract ## Database: Creates the configured database & Executes the SQL needed to generate the database schema.

PHONY: db.create.force
db.create.force: doctrine.database.create.force doctrine.migrations.migrate.nointeract ## Database: Drop & create.

PHONY: db.drop
db.drop: doctrine.database.drop ## Database: Drop.

.PHONY: db.update
db.update: doctrine.migrations.diff doctrine.migrations.migrate ## Database: Generate & execute a Doctrine migration.

##

PHONY: db.validate
db.validate: doctrine.schema.validate ## Database: Validate the mapping files.

PHONY: db.entities
db.entities: doctrine.mapping.info ## Database: List mapped entities.