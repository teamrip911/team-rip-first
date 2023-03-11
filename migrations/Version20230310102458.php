<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230310102458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE animal_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE farm_animal_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE animal_group (id INT NOT NULL, animal_id INT NOT NULL, farm_id INT NOT NULL, count INT NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C339D318E962C16 ON animal_group (animal_id)');
        $this->addSql('CREATE INDEX IDX_4C339D3165FCFA0D ON animal_group (farm_id)');
        $this->addSql('COMMENT ON COLUMN animal_group.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN animal_group.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN animal_group.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE farm_animal_group (id INT NOT NULL, animal_group_id INT NOT NULL, farm_animal_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6F620F838D7DF9A ON farm_animal_group (animal_group_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6F620F85709FAA ON farm_animal_group (farm_animal_id)');
        $this->addSql('COMMENT ON COLUMN farm_animal_group.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal_group.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal_group.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE animal_group ADD CONSTRAINT FK_4C339D318E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE animal_group ADD CONSTRAINT FK_4C339D3165FCFA0D FOREIGN KEY (farm_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animal_group ADD CONSTRAINT FK_6F620F838D7DF9A FOREIGN KEY (animal_group_id) REFERENCES animal_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animal_group ADD CONSTRAINT FK_6F620F85709FAA FOREIGN KEY (farm_animal_id) REFERENCES farm_animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE animal_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE farm_animal_group_id_seq CASCADE');
        $this->addSql('ALTER TABLE animal_group DROP CONSTRAINT FK_4C339D318E962C16');
        $this->addSql('ALTER TABLE animal_group DROP CONSTRAINT FK_4C339D3165FCFA0D');
        $this->addSql('ALTER TABLE farm_animal_group DROP CONSTRAINT FK_6F620F838D7DF9A');
        $this->addSql('ALTER TABLE farm_animal_group DROP CONSTRAINT FK_6F620F85709FAA');
        $this->addSql('DROP TABLE animal_group');
        $this->addSql('DROP TABLE farm_animal_group');
    }
}
