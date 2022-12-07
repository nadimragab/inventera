<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207104402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unite_bien ADD premier_inventaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unite_bien ADD dernier_inventaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D629A59D4 FOREIGN KEY (premier_inventaire_id) REFERENCES inventaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unite_bien ADD CONSTRAINT FK_361BE95D89FF2F16 FOREIGN KEY (dernier_inventaire_id) REFERENCES inventaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_361BE95D629A59D4 ON unite_bien (premier_inventaire_id)');
        $this->addSql('CREATE INDEX IDX_361BE95D89FF2F16 ON unite_bien (dernier_inventaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D629A59D4');
        $this->addSql('ALTER TABLE unite_bien DROP CONSTRAINT FK_361BE95D89FF2F16');
        $this->addSql('DROP INDEX IDX_361BE95D629A59D4');
        $this->addSql('DROP INDEX IDX_361BE95D89FF2F16');
        $this->addSql('ALTER TABLE unite_bien DROP premier_inventaire_id');
        $this->addSql('ALTER TABLE unite_bien DROP dernier_inventaire_id');
    }
}
