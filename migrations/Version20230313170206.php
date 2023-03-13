<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230313170206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE balance_category_relation_id_seq CASCADE');
        $this->addSql('CREATE TABLE balance_balance_category (balance_id INT NOT NULL, balance_category_id INT NOT NULL, PRIMARY KEY(balance_id, balance_category_id))');
        $this->addSql('CREATE INDEX IDX_D599300FAE91A3DD ON balance_balance_category (balance_id)');
        $this->addSql('CREATE INDEX IDX_D599300FC77E7F00 ON balance_balance_category (balance_category_id)');
        $this->addSql('ALTER TABLE balance_balance_category ADD CONSTRAINT FK_D599300FAE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_balance_category ADD CONSTRAINT FK_D599300FC77E7F00 FOREIGN KEY (balance_category_id) REFERENCES balance_categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT fk_62b6ca914dfd750c');
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT fk_62b6ca9112469de2');
        $this->addSql('DROP TABLE balance_category_relation');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE balance_category_relation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE balance_category_relation (id INT NOT NULL, record_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_62b6ca9112469de2 ON balance_category_relation (category_id)');
        $this->addSql('CREATE INDEX idx_62b6ca914dfd750c ON balance_category_relation (record_id)');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT fk_62b6ca914dfd750c FOREIGN KEY (record_id) REFERENCES balance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT fk_62b6ca9112469de2 FOREIGN KEY (category_id) REFERENCES balance_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_balance_category DROP CONSTRAINT FK_D599300FAE91A3DD');
        $this->addSql('ALTER TABLE balance_balance_category DROP CONSTRAINT FK_D599300FC77E7F00');
        $this->addSql('DROP TABLE balance_balance_category');
    }
}
