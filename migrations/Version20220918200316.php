<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918200316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE unite_bien_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE unite_bien (id INT NOT NULL, ref_bien_id INT DEFAULT NULL, nbr_inv INT DEFAULT NULL, etat_phy VARCHAR(50) DEFAULT NULL, num_unite INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_361BE95D7981EBDF ON unite_bien (ref_bien_id)');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D7981EBDF FOREIGN KEY (ref_bien_id) REFERENCES bien (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE unite_bien_id_seq CASCADE');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D7981EBDF');
        $this->addSql('DROP TABLE unite_bien');
    }
}
