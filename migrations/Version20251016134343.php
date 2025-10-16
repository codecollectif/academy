<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251016134343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chapter_chapter (chapter_source INT NOT NULL, chapter_target INT NOT NULL, INDEX IDX_83B0B1614D498F8 (chapter_source), INDEX IDX_83B0B1611D31C877 (chapter_target), PRIMARY KEY(chapter_source, chapter_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chapter_chapter ADD CONSTRAINT FK_83B0B1614D498F8 FOREIGN KEY (chapter_source) REFERENCES chapter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chapter_chapter ADD CONSTRAINT FK_83B0B1611D31C877 FOREIGN KEY (chapter_target) REFERENCES chapter (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chapter_chapter DROP FOREIGN KEY FK_83B0B1614D498F8');
        $this->addSql('ALTER TABLE chapter_chapter DROP FOREIGN KEY FK_83B0B1611D31C877');
        $this->addSql('DROP TABLE chapter_chapter');
    }
}
