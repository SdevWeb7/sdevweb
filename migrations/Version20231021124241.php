<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021124241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__video AS SELECT id, url, description, title, category FROM video');
        $this->addSql('DROP TABLE video');
        $this->addSql('CREATE TABLE video (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO video (id, url, description, title, category) SELECT id, url, description, title, category FROM __temp__video');
        $this->addSql('DROP TABLE __temp__video');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__video AS SELECT id, url, title, description, category FROM video');
        $this->addSql('DROP TABLE video');
        $this->addSql('CREATE TABLE video (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, category VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO video (id, url, title, description, category) SELECT id, url, title, description, category FROM __temp__video');
        $this->addSql('DROP TABLE __temp__video');
    }
}
