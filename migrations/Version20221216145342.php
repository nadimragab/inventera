<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221216145342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE bien_id_seq CASCADE');
        $this->addSql('CREATE TABLE bien (id VARCHAR(255) NOT NULL, service_id INT NOT NULL, structure_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, reference_bien VARCHAR(255) NOT NULL, date_acquisition TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nombre_unite_lot INT NOT NULL, slug VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, compte_actif INT DEFAULT NULL, compte_amortissement INT DEFAULT NULL, compte_dotation INT DEFAULT NULL, affectation SMALLINT DEFAULT NULL, inv_nature VARCHAR(255) DEFAULT NULL, code_inv_nat VARCHAR(255) DEFAULT NULL, libelle_inv_nat VARCHAR(255) DEFAULT NULL, valeur_acquisition INT DEFAULT NULL, valeur_amortissement DOUBLE PRECISION DEFAULT NULL, duree_amortissement INT DEFAULT NULL, etat_amortissement DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_45EDC386ED5CA9E6 ON bien (service_id)');
        $this->addSql('CREATE INDEX IDX_45EDC3862534008B ON bien (structure_id)');
        $this->addSql('CREATE TABLE inventaire (id INT NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, year INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, structure_id INT NOT NULL, nom_service VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, reference_service VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E19D9AD22534008B ON service (structure_id)');
        $this->addSql('CREATE TABLE structure (id INT NOT NULL, nom_structure VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, reference_structure VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE unite_bien (id VARCHAR(255) NOT NULL, ref_bien_id VARCHAR(255) DEFAULT NULL, structure_att_id INT DEFAULT NULL, service_att_id INT DEFAULT NULL, premier_inventaire_id INT DEFAULT NULL, dernier_inventaire_id INT DEFAULT NULL, nbr_inv INT DEFAULT NULL, etat_phy VARCHAR(50) DEFAULT NULL, num_unite INT DEFAULT NULL, ref_unite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_361BE95D7981EBDF ON unite_bien (ref_bien_id)');
        $this->addSql('CREATE INDEX IDX_361BE95D1ADCF790 ON unite_bien (structure_att_id)');
        $this->addSql('CREATE INDEX IDX_361BE95D3DA2158C ON unite_bien (service_att_id)');
        $this->addSql('CREATE INDEX IDX_361BE95D629A59D4 ON unite_bien (premier_inventaire_id)');
        $this->addSql('CREATE INDEX IDX_361BE95D89FF2F16 ON unite_bien (dernier_inventaire_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC3862534008B FOREIGN KEY (structure_id) REFERENCES structure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD22534008B FOREIGN KEY (structure_id) REFERENCES structure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D7981EBDF FOREIGN KEY (ref_bien_id) REFERENCES bien (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D1ADCF790 FOREIGN KEY (structure_att_id) REFERENCES structure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D3DA2158C FOREIGN KEY (service_att_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D629A59D4 FOREIGN KEY (premier_inventaire_id) REFERENCES inventaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D89FF2F16 FOREIGN KEY (dernier_inventaire_id) REFERENCES inventaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE bien_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE bien DROP CONSTRAINT FK_45EDC386ED5CA9E6');
        $this->addSql('ALTER TABLE bien DROP CONSTRAINT FK_45EDC3862534008B');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD22534008B');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D7981EBDF');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D1ADCF790');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D3DA2158C');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D629A59D4');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D89FF2F16');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE structure');
        $this->addSql('DROP TABLE unite_bien');
        $this->addSql('DROP TABLE "user"');
    }
}
