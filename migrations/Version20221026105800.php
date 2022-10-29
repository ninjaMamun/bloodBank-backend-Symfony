<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026105800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE donor DROP FOREIGN KEY FK_D7F240973DD7B7A7');
        $this->addSql('DROP INDEX IDX_D7F240973DD7B7A7 ON donor');
        $this->addSql('ALTER TABLE donor ADD area_id INT NOT NULL, DROP donor_id');
        $this->addSql('ALTER TABLE donor ADD CONSTRAINT FK_D7F24097BD0F409C FOREIGN KEY (area_id) REFERENCES area (id)');
        $this->addSql('CREATE INDEX IDX_D7F24097BD0F409C ON donor (area_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE donor DROP FOREIGN KEY FK_D7F24097BD0F409C');
        $this->addSql('DROP INDEX IDX_D7F24097BD0F409C ON donor');
        $this->addSql('ALTER TABLE donor ADD donor_id INT DEFAULT NULL, DROP area_id');
        $this->addSql('ALTER TABLE donor ADD CONSTRAINT FK_D7F240973DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D7F240973DD7B7A7 ON donor (donor_id)');
    }
}
