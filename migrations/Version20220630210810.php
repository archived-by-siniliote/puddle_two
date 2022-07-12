<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630210810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE log_entries_post_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE blog_post (id UUID NOT NULL, post_id UUID NOT NULL, slug VARCHAR(128) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA5AE01D989D9B62 ON blog_post (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA5AE01D4B89032C ON blog_post (post_id)');
        $this->addSql('COMMENT ON COLUMN blog_post.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN blog_post.post_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE comment (id UUID NOT NULL, blog_post_id UUID DEFAULT NULL, author_id UUID NOT NULL, content TEXT NOT NULL, published_at DATE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CA77FBEAF ON comment (blog_post_id)');
        $this->addSql('CREATE INDEX IDX_9474526CF675F31B ON comment (author_id)');
        $this->addSql('COMMENT ON COLUMN comment.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN comment.blog_post_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN comment.author_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN comment.published_at IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE log_entries_post (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(191) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(191) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN log_entries_post.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE post (id UUID NOT NULL, created_by UUID DEFAULT NULL, updated_by UUID DEFAULT NULL, content_changed_by UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, body VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DDE12AB56 ON post (created_by)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D16FE72E1 ON post (updated_by)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D8985DB6D ON post (content_changed_by)');
        $this->addSql('COMMENT ON COLUMN post.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN post.created_by IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN post.updated_by IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN post.content_changed_by IS \'(DC2Type:ulid)\'');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01D4B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA77FBEAF FOREIGN KEY (blog_post_id) REFERENCES blog_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DDE12AB56 FOREIGN KEY (created_by) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D16FE72E1 FOREIGN KEY (updated_by) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D8985DB6D FOREIGN KEY (content_changed_by) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CA77FBEAF');
        $this->addSql('ALTER TABLE blog_post DROP CONSTRAINT FK_BA5AE01D4B89032C');
        $this->addSql('DROP SEQUENCE log_entries_post_id_seq CASCADE');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE log_entries_post');
        $this->addSql('DROP TABLE post');
    }
}
