<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231022170828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE todo (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, from_user_id INTEGER NOT NULL, content VARCHAR(255) NOT NULL, is_done BOOLEAN NOT NULL, CONSTRAINT FK_5A0EB6A02130303A FOREIGN KEY (from_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5A0EB6A02130303A ON todo (from_user_id)');
        $this->addSql('DROP TABLE react');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE react (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, url VARCHAR(255) NOT NULL COLLATE "BINARY", title VARCHAR(255) NOT NULL COLLATE "BINARY", description VARCHAR(255) NOT NULL COLLATE "BINARY")');
        $this->addSql('DROP TABLE todo');
    }
}
