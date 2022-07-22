<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220722095335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_tag DROP CONSTRAINT fk_5ace3af04b89032c');
        $this->addSql('CREATE TABLE "blog_post" (id UUID NOT NULL, author_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, body TEXT NOT NULL, published_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, current_place JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA5AE01D989D9B62 ON "blog_post" (slug)');
        $this->addSql('CREATE INDEX IDX_BA5AE01DF675F31B ON "blog_post" (author_id)');
        $this->addSql('COMMENT ON COLUMN "blog_post".id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN "blog_post".author_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN "blog_post".published_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE blog_post_tag (blog_post_id UUID NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(blog_post_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_2E931ED7A77FBEAF ON blog_post_tag (blog_post_id)');
        $this->addSql('CREATE INDEX IDX_2E931ED7BAD26311 ON blog_post_tag (tag_id)');
        $this->addSql('COMMENT ON COLUMN blog_post_tag.blog_post_id IS \'(DC2Type:ulid)\'');
        $this->addSql('ALTER TABLE "blog_post" ADD CONSTRAINT FK_BA5AE01DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_tag ADD CONSTRAINT FK_2E931ED7A77FBEAF FOREIGN KEY (blog_post_id) REFERENCES "blog_post" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE blog_post_tag ADD CONSTRAINT FK_2E931ED7BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE post_tag');
        $this->addSql('DROP TABLE post');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE blog_post_tag DROP CONSTRAINT FK_2E931ED7A77FBEAF');
        $this->addSql('CREATE TABLE post_tag (post_id UUID NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('CREATE INDEX idx_5ace3af0bad26311 ON post_tag (tag_id)');
        $this->addSql('CREATE INDEX idx_5ace3af04b89032c ON post_tag (post_id)');
        $this->addSql('COMMENT ON COLUMN post_tag.post_id IS \'(DC2Type:ulid)\'');
        $this->addSql('CREATE TABLE post (id UUID NOT NULL, author_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, body TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, slug VARCHAR(128) NOT NULL, published_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_5a8a6c8df675f31b ON post (author_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_5a8a6c8d989d9b62 ON post (slug)');
        $this->addSql('COMMENT ON COLUMN post.id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN post.author_id IS \'(DC2Type:ulid)\'');
        $this->addSql('COMMENT ON COLUMN post.published_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT fk_5ace3af04b89032c FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT fk_5ace3af0bad26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT fk_5a8a6c8df675f31b FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "blog_post"');
        $this->addSql('DROP TABLE blog_post_tag');
    }
}
