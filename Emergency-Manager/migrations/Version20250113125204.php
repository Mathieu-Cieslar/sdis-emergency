<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250113125204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE camion ADD caserne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE camion ADD coor_x VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE camion ADD coor_y VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE camion ADD CONSTRAINT FK_5DD566EC9C03C926 FOREIGN KEY (caserne_id) REFERENCES caserne (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_5DD566EC9C03C926 ON camion (caserne_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE camion DROP CONSTRAINT FK_5DD566EC9C03C926');
        $this->addSql('DROP INDEX IDX_5DD566EC9C03C926');
        $this->addSql('ALTER TABLE camion DROP caserne_id');
        $this->addSql('ALTER TABLE camion DROP coor_x');
        $this->addSql('ALTER TABLE camion DROP coor_y');
    }
}
