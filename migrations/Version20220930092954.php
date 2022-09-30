<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930092954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bd ADD cover_picture VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE book ADD cover_picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cd ADD cover_picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE comic ADD cover_picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE lp ADD cover_picture VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE manga ADD cover_picture VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lp DROP cover_picture');
        $this->addSql('ALTER TABLE cd DROP cover_picture');
        $this->addSql('ALTER TABLE manga DROP cover_picture');
        $this->addSql('ALTER TABLE book DROP cover_picture');
        $this->addSql('ALTER TABLE comic DROP cover_picture');
        $this->addSql('ALTER TABLE bd DROP cover_picture');
    }
}
