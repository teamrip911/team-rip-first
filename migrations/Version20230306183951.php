<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306183951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notes ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notes ALTER category_id DROP NOT NULL');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_11BA68C12469DE2 ON notes (category_id)');
        $this->addSql('CREATE INDEX IDX_11BA68CA76ED395 ON notes (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE notes DROP CONSTRAINT FK_11BA68C12469DE2');
        $this->addSql('ALTER TABLE notes DROP CONSTRAINT FK_11BA68CA76ED395');
        $this->addSql('DROP INDEX IDX_11BA68C12469DE2');
        $this->addSql('DROP INDEX IDX_11BA68CA76ED395');
        $this->addSql('ALTER TABLE notes DROP user_id');
        $this->addSql('ALTER TABLE notes ALTER category_id SET NOT NULL');
    }
}
