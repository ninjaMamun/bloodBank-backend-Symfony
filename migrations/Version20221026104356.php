<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221026104356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donor (id INT AUTO_INCREMENT NOT NULL, donor_id INT DEFAULT NULL, blood_group VARCHAR(3) NOT NULL, name VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, last_donate_date DATE DEFAULT NULL, number_of_donation INT DEFAULT NULL, profile_picture VARCHAR(255) NOT NULL, INDEX IDX_D7F240973DD7B7A7 (donor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donor ADD CONSTRAINT FK_D7F240973DD7B7A7 FOREIGN KEY (donor_id) REFERENCES donor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE donor DROP FOREIGN KEY FK_D7F240973DD7B7A7');
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE donor');
    }
}
