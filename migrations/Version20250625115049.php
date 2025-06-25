<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250625115049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE story (id SERIAL NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_EB560438F675F31B ON story (author_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE story_choice (id SERIAL NOT NULL, story_step_id INT NOT NULL, next_step_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8EA8E860204E8E1E ON story_choice (story_step_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8EA8E860B13C343E ON story_choice (next_step_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE story_step (id SERIAL NOT NULL, story_id INT DEFAULT NULL, description TEXT NOT NULL, is_start BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_D5149212AA5D4036 ON story_step (story_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story ADD CONSTRAINT FK_EB560438F675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story_choice ADD CONSTRAINT FK_8EA8E860204E8E1E FOREIGN KEY (story_step_id) REFERENCES story_step (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story_choice ADD CONSTRAINT FK_8EA8E860B13C343E FOREIGN KEY (next_step_id) REFERENCES story_step (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story_step ADD CONSTRAINT FK_D5149212AA5D4036 FOREIGN KEY (story_id) REFERENCES story (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story DROP CONSTRAINT FK_EB560438F675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story_choice DROP CONSTRAINT FK_8EA8E860204E8E1E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story_choice DROP CONSTRAINT FK_8EA8E860B13C343E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE story_step DROP CONSTRAINT FK_D5149212AA5D4036
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE story
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE story_choice
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE story_step
        SQL);
    }
}
