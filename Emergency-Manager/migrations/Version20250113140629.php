<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113140629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camion_intervention DROP CONSTRAINT fk_4aedb0593a706d3');
        $this->addSql('ALTER TABLE camion_intervention DROP CONSTRAINT fk_4aedb0598eae3863');
        $this->addSql('DROP TABLE camion_intervention');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE camion_intervention (camion_id INT NOT NULL, intervention_id INT NOT NULL, PRIMARY KEY(camion_id, intervention_id))');
        $this->addSql('CREATE INDEX idx_4aedb0598eae3863 ON camion_intervention (intervention_id)');
        $this->addSql('CREATE INDEX idx_4aedb0593a706d3 ON camion_intervention (camion_id)');
        $this->addSql('ALTER TABLE camion_intervention ADD CONSTRAINT fk_4aedb0593a706d3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE camion_intervention ADD CONSTRAINT fk_4aedb0598eae3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
