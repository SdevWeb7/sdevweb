<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231021205029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__like AS SELECT id, to_youtube_id, from_user_id FROM "like"');
        $this->addSql('DROP TABLE "like"');
        $this->addSql('CREATE TABLE "like" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, to_video_id INTEGER NOT NULL, from_user_id INTEGER NOT NULL, CONSTRAINT FK_AC6340B32130303A FOREIGN KEY (from_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC6340B3E4989EE0 FOREIGN KEY (to_video_id) REFERENCES video (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "like" (id, to_video_id, from_user_id) SELECT id, to_youtube_id, from_user_id FROM __temp__like');
        $this->addSql('DROP TABLE __temp__like');
        $this->addSql('CREATE INDEX IDX_AC6340B32130303A ON "like" (from_user_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B3E4989EE0 ON "like" (to_video_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__like AS SELECT id, to_video_id, from_user_id FROM "like"');
        $this->addSql('DROP TABLE "like"');
        $this->addSql('CREATE TABLE "like" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, to_youtube_id INTEGER NOT NULL, from_user_id INTEGER NOT NULL, CONSTRAINT FK_AC6340B32130303A FOREIGN KEY (from_user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AC6340B39C4DA2AC FOREIGN KEY (to_youtube_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO "like" (id, to_youtube_id, from_user_id) SELECT id, to_video_id, from_user_id FROM __temp__like');
        $this->addSql('DROP TABLE __temp__like');
        $this->addSql('CREATE INDEX IDX_AC6340B32130303A ON "like" (from_user_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B39C4DA2AC ON "like" (to_youtube_id)');
    }
}
