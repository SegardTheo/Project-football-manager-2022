<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204145149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stats (id INT AUTO_INCREMENT NOT NULL, strength INT NOT NULL, physical_condition INT NOT NULL, defense INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player ADD stats_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6570AA3482 FOREIGN KEY (stats_id) REFERENCES stats (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_98197A6570AA3482 ON player (stats_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6570AA3482');
        $this->addSql('DROP TABLE stats');
        $this->addSql('DROP INDEX UNIQ_98197A6570AA3482 ON player');
        $this->addSql('ALTER TABLE player DROP stats_id, CHANGE name name VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
