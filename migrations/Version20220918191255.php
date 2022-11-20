<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918191255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE structure (id INT NOT NULL, nom_structure VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, reference_structure VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE service (id INT NOT NULL, structure_id INT NOT NULL, nom_service VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, reference_service VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_e19d9ad22534008b ON service (structure_id)');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d649e7927c74 ON "user" (email)');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE TABLE bien (id INT NOT NULL, service_id INT NOT NULL, structure_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description TEXT NOT NULL, reference_bien VARCHAR(255) NOT NULL, date_acquisition TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, nombre_unite_lot INT NOT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, compte_actif INT DEFAULT NULL, compte_amortissement INT DEFAULT NULL, compte_dotation INT DEFAULT NULL, affectation SMALLINT DEFAULT NULL, inv_nature VARCHAR(255) DEFAULT NULL, code_inv_nat VARCHAR(255) DEFAULT NULL, libelle_inv_nat VARCHAR(255) DEFAULT NULL, valeur_acquisition INT DEFAULT NULL, valeur_amortissement DOUBLE PRECISION DEFAULT NULL, duree_amortissement INT DEFAULT NULL, etat_amortissement DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_45edc3862534008b ON bien (structure_id)');
        $this->addSql('CREATE INDEX idx_45edc386ed5ca9e6 ON bien (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE structure');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE service');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE "user"');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP TABLE bien');
    }
}
