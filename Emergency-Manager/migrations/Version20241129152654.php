<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241129152654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE camion (id SERIAL NOT NULL, nb_pompier INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE camion_intervention (camion_id INT NOT NULL, intervention_id INT NOT NULL, PRIMARY KEY(camion_id, intervention_id))');
        $this->addSql('CREATE INDEX IDX_4AEDB0593A706D3 ON camion_intervention (camion_id)');
        $this->addSql('CREATE INDEX IDX_4AEDB0598EAE3863 ON camion_intervention (intervention_id)');
        $this->addSql('CREATE TABLE capteur (id SERIAL NOT NULL, intensite INT DEFAULT NULL, type_capteur VARCHAR(255) DEFAULT NULL, coor_x VARCHAR(255) DEFAULT NULL, coor_y VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE caserne (id SERIAL NOT NULL, coor_x VARCHAR(255) DEFAULT NULL, coor_y VARCHAR(255) DEFAULT NULL, nb_camion INT DEFAULT NULL, nb_pompier INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE intervention (id SERIAL NOT NULL, feu_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D11814ABFB5CF955 ON intervention (feu_id)');
        $this->addSql('ALTER TABLE camion_intervention ADD CONSTRAINT FK_4AEDB0593A706D3 FOREIGN KEY (camion_id) REFERENCES camion (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE camion_intervention ADD CONSTRAINT FK_4AEDB0598EAE3863 FOREIGN KEY (intervention_id) REFERENCES intervention (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABFB5CF955 FOREIGN KEY (feu_id) REFERENCES feu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE camion_intervention DROP CONSTRAINT FK_4AEDB0593A706D3');
        $this->addSql('ALTER TABLE camion_intervention DROP CONSTRAINT FK_4AEDB0598EAE3863');
        $this->addSql('ALTER TABLE intervention DROP CONSTRAINT FK_D11814ABFB5CF955');
        $this->addSql('DROP TABLE camion');
        $this->addSql('DROP TABLE camion_intervention');
        $this->addSql('DROP TABLE capteur');
        $this->addSql('DROP TABLE caserne');
        $this->addSql('DROP TABLE intervention');
    }
}
