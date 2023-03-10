<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310101817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE farm_animal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE farm_animal (id INT NOT NULL, farm_id INT NOT NULL, animal_id INT NOT NULL, nickname VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_768CC70265FCFA0D ON farm_animal (farm_id)');
        $this->addSql('CREATE INDEX IDX_768CC7028E962C16 ON farm_animal (animal_id)');
        $this->addSql('COMMENT ON COLUMN farm_animal.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE farm_animal ADD CONSTRAINT FK_768CC70265FCFA0D FOREIGN KEY (farm_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animal ADD CONSTRAINT FK_768CC7028E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE farm_animal_id_seq CASCADE');
        $this->addSql('ALTER TABLE farm_animal DROP CONSTRAINT FK_768CC70265FCFA0D');
        $this->addSql('ALTER TABLE farm_animal DROP CONSTRAINT FK_768CC7028E962C16');
        $this->addSql('DROP TABLE farm_animal');
    }
}
