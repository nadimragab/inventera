<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220720134409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien ADD compte_actif INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien ADD compte_amortissement INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien ADD compte_dotation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien ADD affectation SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE bien ADD inv_nature VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bien DROP compte_actif');
        $this->addSql('ALTER TABLE bien DROP compte_amortissement');
        $this->addSql('ALTER TABLE bien DROP compte_dotation');
        $this->addSql('ALTER TABLE bien DROP affectation');
        $this->addSql('ALTER TABLE bien DROP inv_nature');
    }
}
