<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220923130737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD pseudo VARCHAR(255) NOT NULL, ADD birth_date DATE NOT NULL, ADD profile_picture VARCHAR(255) DEFAULT NULL, ADD book_count INT DEFAULT NULL, ADD bd_count INT DEFAULT NULL, ADD comics_count INT DEFAULT NULL, ADD manga_count INT DEFAULT NULL, ADD cd_count INT DEFAULT NULL, ADD lp_count INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP pseudo, DROP birth_date, DROP profile_picture, DROP book_count, DROP bd_count, DROP comics_count, DROP manga_count, DROP cd_count, DROP lp_count');
    }
}
