<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408205057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bien_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bien (id INT NOT NULL, service_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, reference_bien VARCHAR(255) NOT NULL, date_acquisition TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nombre_unite_lot INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_45EDC386ED5CA9E6 ON bien (service_id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD reference_service VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE structure ADD reference_structure VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bien_id_seq CASCADE');
        $this->addSql('DROP TABLE bien');
        $this->addSql('ALTER TABLE structure DROP reference_structure');
        $this->addSql('ALTER TABLE service DROP reference_service');
    }
}
