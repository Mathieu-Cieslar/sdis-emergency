<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250112154200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention ADD trajet TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD temps_trajet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intervention ADD date_intervention TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN intervention.trajet IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE intervention DROP trajet');
        $this->addSql('ALTER TABLE intervention DROP temps_trajet');
        $this->addSql('ALTER TABLE intervention DROP date_intervention');
    }
}
