<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230312185636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE balance DROP CONSTRAINT fk_acf41ffe34c1e106');
        $this->addSql('ALTER TABLE balance DROP CONSTRAINT fk_acf41ffe9d86650f');
        $this->addSql('DROP INDEX idx_acf41ffe9d86650f');
        $this->addSql('DROP INDEX idx_acf41ffe34c1e106');
        $this->addSql('ALTER TABLE balance ADD farm_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance DROP farm_id_id');
        $this->addSql('ALTER TABLE balance DROP user_id_id');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT FK_ACF41FFE65FCFA0D FOREIGN KEY (farm_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT FK_ACF41FFEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ACF41FFE65FCFA0D ON balance (farm_id)');
        $this->addSql('CREATE INDEX IDX_ACF41FFEA76ED395 ON balance (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE balance DROP CONSTRAINT FK_ACF41FFE65FCFA0D');
        $this->addSql('ALTER TABLE balance DROP CONSTRAINT FK_ACF41FFEA76ED395');
        $this->addSql('DROP INDEX IDX_ACF41FFE65FCFA0D');
        $this->addSql('DROP INDEX IDX_ACF41FFEA76ED395');
        $this->addSql('ALTER TABLE balance ADD farm_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE balance DROP farm_id');
        $this->addSql('ALTER TABLE balance DROP user_id');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT fk_acf41ffe34c1e106 FOREIGN KEY (farm_id_id) REFERENCES farms (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT fk_acf41ffe9d86650f FOREIGN KEY (user_id_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_acf41ffe9d86650f ON balance (user_id_id)');
        $this->addSql('CREATE INDEX idx_acf41ffe34c1e106 ON balance (farm_id_id)');
    }
}
