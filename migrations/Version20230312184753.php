<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312184753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE farm_animal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE animal_group_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE farm_animal_group_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE animal_groups_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE balance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE balance_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE balance_category_relation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE farm_animals_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE farm_animals_groups_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE animal_groups (id INT NOT NULL, animal_id INT NOT NULL, farm_id INT NOT NULL, count INT NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4A9CFCAC8E962C16 ON animal_groups (animal_id)');
        $this->addSql('CREATE INDEX IDX_4A9CFCAC65FCFA0D ON animal_groups (farm_id)');
        $this->addSql('COMMENT ON COLUMN animal_groups.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN animal_groups.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN animal_groups.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE balance (id INT NOT NULL, farm_id_id INT NOT NULL, user_id_id INT NOT NULL, record_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, amount INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_ACF41FFE34C1E106 ON balance (farm_id_id)');
        $this->addSql('CREATE INDEX IDX_ACF41FFE9D86650F ON balance (user_id_id)');
        $this->addSql('COMMENT ON COLUMN balance.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN balance.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN balance.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE balance_categories (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE balance_category_relation (id INT NOT NULL, record_id_id INT NOT NULL, category_id_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62B6CA91FE1F3F0B ON balance_category_relation (record_id_id)');
        $this->addSql('CREATE INDEX IDX_62B6CA919777D11E ON balance_category_relation (category_id_id)');
        $this->addSql('CREATE TABLE farm_animals (id INT NOT NULL, farm_id INT NOT NULL, animal_id INT NOT NULL, nickname VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, description TEXT DEFAULT NULL, date_of_birth TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F57622E065FCFA0D ON farm_animals (farm_id)');
        $this->addSql('CREATE INDEX IDX_F57622E08E962C16 ON farm_animals (animal_id)');
        $this->addSql('COMMENT ON COLUMN farm_animals.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animals.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animals.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE farm_animals_groups (id INT NOT NULL, animal_group_id INT NOT NULL, farm_animal_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_87B02F2338D7DF9A ON farm_animals_groups (animal_group_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_87B02F235709FAA ON farm_animals_groups (farm_animal_id)');
        $this->addSql('COMMENT ON COLUMN farm_animals_groups.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animals_groups.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animals_groups.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE animal_groups ADD CONSTRAINT FK_4A9CFCAC8E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE animal_groups ADD CONSTRAINT FK_4A9CFCAC65FCFA0D FOREIGN KEY (farm_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT FK_ACF41FFE34C1E106 FOREIGN KEY (farm_id_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT FK_ACF41FFE9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT FK_62B6CA91FE1F3F0B FOREIGN KEY (record_id_id) REFERENCES balance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance_category_relation ADD CONSTRAINT FK_62B6CA919777D11E FOREIGN KEY (category_id_id) REFERENCES balance_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animals ADD CONSTRAINT FK_F57622E065FCFA0D FOREIGN KEY (farm_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animals ADD CONSTRAINT FK_F57622E08E962C16 FOREIGN KEY (animal_id) REFERENCES animals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animals_groups ADD CONSTRAINT FK_87B02F2338D7DF9A FOREIGN KEY (animal_group_id) REFERENCES animal_groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animals_groups ADD CONSTRAINT FK_87B02F235709FAA FOREIGN KEY (farm_animal_id) REFERENCES farm_animals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animal DROP CONSTRAINT fk_768cc70265fcfa0d');
        $this->addSql('ALTER TABLE farm_animal DROP CONSTRAINT fk_768cc7028e962c16');
        $this->addSql('ALTER TABLE animal_group DROP CONSTRAINT fk_4c339d318e962c16');
        $this->addSql('ALTER TABLE animal_group DROP CONSTRAINT fk_4c339d3165fcfa0d');
        $this->addSql('ALTER TABLE farm_animal_group DROP CONSTRAINT fk_6f620f838d7df9a');
        $this->addSql('ALTER TABLE farm_animal_group DROP CONSTRAINT fk_6f620f85709faa');
        $this->addSql('DROP TABLE farm_animal');
        $this->addSql('DROP TABLE animal_group');
        $this->addSql('DROP TABLE farm_animal_group');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE animal_groups_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE balance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE balance_categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE balance_category_relation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE farm_animals_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE farm_animals_groups_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE farm_animal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE animal_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE farm_animal_group_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE farm_animal (id INT NOT NULL, farm_id INT NOT NULL, animal_id INT NOT NULL, nickname VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, description TEXT DEFAULT NULL, date_of_birth TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_768cc7028e962c16 ON farm_animal (animal_id)');
        $this->addSql('CREATE INDEX idx_768cc70265fcfa0d ON farm_animal (farm_id)');
        $this->addSql('COMMENT ON COLUMN farm_animal.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE animal_group (id INT NOT NULL, animal_id INT NOT NULL, farm_id INT NOT NULL, count INT NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_4c339d3165fcfa0d ON animal_group (farm_id)');
        $this->addSql('CREATE INDEX idx_4c339d318e962c16 ON animal_group (animal_id)');
        $this->addSql('COMMENT ON COLUMN animal_group.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN animal_group.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN animal_group.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE farm_animal_group (id INT NOT NULL, animal_group_id INT NOT NULL, farm_animal_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_6f620f85709faa ON farm_animal_group (farm_animal_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_6f620f838d7df9a ON farm_animal_group (animal_group_id)');
        $this->addSql('COMMENT ON COLUMN farm_animal_group.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal_group.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN farm_animal_group.deleted_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE farm_animal ADD CONSTRAINT fk_768cc70265fcfa0d FOREIGN KEY (farm_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animal ADD CONSTRAINT fk_768cc7028e962c16 FOREIGN KEY (animal_id) REFERENCES animals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE animal_group ADD CONSTRAINT fk_4c339d318e962c16 FOREIGN KEY (animal_id) REFERENCES animals (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE animal_group ADD CONSTRAINT fk_4c339d3165fcfa0d FOREIGN KEY (farm_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animal_group ADD CONSTRAINT fk_6f620f838d7df9a FOREIGN KEY (animal_group_id) REFERENCES animal_group (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE farm_animal_group ADD CONSTRAINT fk_6f620f85709faa FOREIGN KEY (farm_animal_id) REFERENCES farm_animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE animal_groups DROP CONSTRAINT FK_4A9CFCAC8E962C16');
        $this->addSql('ALTER TABLE animal_groups DROP CONSTRAINT FK_4A9CFCAC65FCFA0D');
        $this->addSql('ALTER TABLE balance DROP CONSTRAINT FK_ACF41FFE34C1E106');
        $this->addSql('ALTER TABLE balance DROP CONSTRAINT FK_ACF41FFE9D86650F');
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT FK_62B6CA91FE1F3F0B');
        $this->addSql('ALTER TABLE balance_category_relation DROP CONSTRAINT FK_62B6CA919777D11E');
        $this->addSql('ALTER TABLE farm_animals DROP CONSTRAINT FK_F57622E065FCFA0D');
        $this->addSql('ALTER TABLE farm_animals DROP CONSTRAINT FK_F57622E08E962C16');
        $this->addSql('ALTER TABLE farm_animals_groups DROP CONSTRAINT FK_87B02F2338D7DF9A');
        $this->addSql('ALTER TABLE farm_animals_groups DROP CONSTRAINT FK_87B02F235709FAA');
        $this->addSql('DROP TABLE animal_groups');
        $this->addSql('DROP TABLE balance');
        $this->addSql('DROP TABLE balance_categories');
        $this->addSql('DROP TABLE balance_category_relation');
        $this->addSql('DROP TABLE farm_animals');
        $this->addSql('DROP TABLE farm_animals_groups');
    }
}
