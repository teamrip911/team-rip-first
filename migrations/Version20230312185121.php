<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312185121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT fk_62b6ca91fe1f3f0b');
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT fk_62b6ca919777d11e');
        $this->addSql('DROP INDEX idx_62b6ca919777d11e');
        $this->addSql('DROP INDEX idx_62b6ca91fe1f3f0b');
        $this->addSql('ALTER TABLE balance_category_relation ADD record_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance_category_relation ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance_category_relation DROP record_id_id');
        $this->addSql('ALTER TABLE balance_category_relation DROP category_id_id');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT FK_62B6CA914DFD750C FOREIGN KEY (record_id) REFERENCES balance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT FK_62B6CA9112469DE2 FOREIGN KEY (category_id) REFERENCES balance_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_62B6CA914DFD750C ON balance_category_relation (record_id)');
        $this->addSql('CREATE INDEX IDX_62B6CA9112469DE2 ON balance_category_relation (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT FK_62B6CA914DFD750C');
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT FK_62B6CA9112469DE2');
        $this->addSql('DROP INDEX IDX_62B6CA914DFD750C');
        $this->addSql('DROP INDEX IDX_62B6CA9112469DE2');
        $this->addSql('ALTER TABLE balance_category_relation ADD record_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance_category_relation ADD category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance_category_relation DROP record_id');
        $this->addSql('ALTER TABLE balance_category_relation DROP category_id');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT fk_62b6ca91fe1f3f0b FOREIGN KEY (record_id_id) REFERENCES balance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT fk_62b6ca919777d11e FOREIGN KEY (category_id_id) REFERENCES balance_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_62b6ca919777d11e ON balance_category_relation (category_id_id)');
        $this->addSql('CREATE INDEX idx_62b6ca91fe1f3f0b ON balance_category_relation (record_id_id)');
    }
}
