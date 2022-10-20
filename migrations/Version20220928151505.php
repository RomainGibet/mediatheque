<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928151505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bd CHANGE isbn isbn VARCHAR(255) NOT NULL, CHANGE year year VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE book CHANGE isbn isbn VARCHAR(255) NOT NULL, CHANGE year year VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cd CHANGE cat_number cat_number VARCHAR(255) NOT NULL, CHANGE year year VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE comic CHANGE isbn isbn VARCHAR(255) NOT NULL, CHANGE year year VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE lp CHANGE cat_number cat_number VARCHAR(255) NOT NULL, CHANGE year year VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE manga CHANGE isbn isbn VARCHAR(255) NOT NULL, CHANGE year year VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lp CHANGE cat_number cat_number INT NOT NULL, CHANGE year year DATE NOT NULL');
        $this->addSql('ALTER TABLE cd CHANGE cat_number cat_number INT NOT NULL, CHANGE year year DATE NOT NULL');
        $this->addSql('ALTER TABLE manga CHANGE isbn isbn INT NOT NULL, CHANGE year year DATE NOT NULL');
        $this->addSql('ALTER TABLE book CHANGE isbn isbn INT NOT NULL, CHANGE year year DATE NOT NULL');
        $this->addSql('ALTER TABLE comic CHANGE isbn isbn INT NOT NULL, CHANGE year year DATE NOT NULL');
        $this->addSql('ALTER TABLE bd CHANGE isbn isbn INT NOT NULL, CHANGE year year DATE NOT NULL');
    }
}
