<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221019122246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unite_bien ADD structure_att_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unite_bien ADD service_att_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D1ADCF790 FOREIGN KEY (structure_att_id) REFERENCES structure (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D3DA2158C FOREIGN KEY (service_att_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_361BE95D1ADCF790 ON unite_bien (structure_att_id)');
        $this->addSql('CREATE INDEX IDX_361BE95D3DA2158C ON unite_bien (service_att_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D1ADCF790');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D3DA2158C');
        $this->addSql('DROP INDEX IDX_361BE95D1ADCF790');
        $this->addSql('DROP INDEX IDX_361BE95D3DA2158C');
        $this->addSql('ALTER TABLE unite_bien DROP structure_att_id');
        $this->addSql('ALTER TABLE unite_bien DROP service_att_id');
    }
}
