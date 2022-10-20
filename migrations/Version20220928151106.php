<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220928151106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bd (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, isbn INT NOT NULL, editor VARCHAR(255) NOT NULL, year DATE NOT NULL, country VARCHAR(255) NOT NULL, genre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, isbn INT NOT NULL, editor VARCHAR(255) NOT NULL, year DATE NOT NULL, country VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cd (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, cat_number INT NOT NULL, label VARCHAR(255) NOT NULL, year DATE NOT NULL, country VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comic (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, isbn INT NOT NULL, editor VARCHAR(255) NOT NULL, year DATE NOT NULL, country VARCHAR(255) NOT NULL, genre VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lp (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, cat_number INT NOT NULL, label VARCHAR(255) NOT NULL, year DATE NOT NULL, country VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manga (id INT AUTO_INCREMENT NOT NULL, author VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, isbn INT NOT NULL, editor VARCHAR(255) NOT NULL, year DATE NOT NULL, country VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, book_count INT DEFAULT NULL, bd_count INT DEFAULT NULL, comics_count INT DEFAULT NULL, manga_count INT DEFAULT NULL, cd_count INT DEFAULT NULL, lp_count INT DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_book (user_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_B164EFF8A76ED395 (user_id), INDEX IDX_B164EFF816A2B381 (book_id), PRIMARY KEY(user_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_bd (user_id INT NOT NULL, bd_id INT NOT NULL, INDEX IDX_449A0A5EA76ED395 (user_id), INDEX IDX_449A0A5E894AF46 (bd_id), PRIMARY KEY(user_id, bd_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_comic (user_id INT NOT NULL, comic_id INT NOT NULL, INDEX IDX_B9BC5EF2A76ED395 (user_id), INDEX IDX_B9BC5EF2D663094A (comic_id), PRIMARY KEY(user_id, comic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_manga (user_id INT NOT NULL, manga_id INT NOT NULL, INDEX IDX_9498655BA76ED395 (user_id), INDEX IDX_9498655B7B6461 (manga_id), PRIMARY KEY(user_id, manga_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_cd (user_id INT NOT NULL, cd_id INT NOT NULL, INDEX IDX_5D813B1FA76ED395 (user_id), INDEX IDX_5D813B1F35F486F6 (cd_id), PRIMARY KEY(user_id, cd_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_lp (user_id INT NOT NULL, lp_id INT NOT NULL, INDEX IDX_C0C3F3ADA76ED395 (user_id), INDEX IDX_C0C3F3AD68DFD1EF (lp_id), PRIMARY KEY(user_id, lp_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_book ADD CONSTRAINT FK_B164EFF8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_book ADD CONSTRAINT FK_B164EFF816A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_bd ADD CONSTRAINT FK_449A0A5EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_bd ADD CONSTRAINT FK_449A0A5E894AF46 FOREIGN KEY (bd_id) REFERENCES bd (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_comic ADD CONSTRAINT FK_B9BC5EF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_comic ADD CONSTRAINT FK_B9BC5EF2D663094A FOREIGN KEY (comic_id) REFERENCES comic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_manga ADD CONSTRAINT FK_9498655BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_manga ADD CONSTRAINT FK_9498655B7B6461 FOREIGN KEY (manga_id) REFERENCES manga (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_cd ADD CONSTRAINT FK_5D813B1FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_cd ADD CONSTRAINT FK_5D813B1F35F486F6 FOREIGN KEY (cd_id) REFERENCES cd (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_lp ADD CONSTRAINT FK_C0C3F3ADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_lp ADD CONSTRAINT FK_C0C3F3AD68DFD1EF FOREIGN KEY (lp_id) REFERENCES lp (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_book DROP FOREIGN KEY FK_B164EFF8A76ED395');
        $this->addSql('ALTER TABLE user_book DROP FOREIGN KEY FK_B164EFF816A2B381');
        $this->addSql('ALTER TABLE user_bd DROP FOREIGN KEY FK_449A0A5EA76ED395');
        $this->addSql('ALTER TABLE user_bd DROP FOREIGN KEY FK_449A0A5E894AF46');
        $this->addSql('ALTER TABLE user_comic DROP FOREIGN KEY FK_B9BC5EF2A76ED395');
        $this->addSql('ALTER TABLE user_comic DROP FOREIGN KEY FK_B9BC5EF2D663094A');
        $this->addSql('ALTER TABLE user_manga DROP FOREIGN KEY FK_9498655BA76ED395');
        $this->addSql('ALTER TABLE user_manga DROP FOREIGN KEY FK_9498655B7B6461');
        $this->addSql('ALTER TABLE user_cd DROP FOREIGN KEY FK_5D813B1FA76ED395');
        $this->addSql('ALTER TABLE user_cd DROP FOREIGN KEY FK_5D813B1F35F486F6');
        $this->addSql('ALTER TABLE user_lp DROP FOREIGN KEY FK_C0C3F3ADA76ED395');
        $this->addSql('ALTER TABLE user_lp DROP FOREIGN KEY FK_C0C3F3AD68DFD1EF');
        $this->addSql('DROP TABLE bd');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE cd');
        $this->addSql('DROP TABLE comic');
        $this->addSql('DROP TABLE lp');
        $this->addSql('DROP TABLE manga');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_book');
        $this->addSql('DROP TABLE user_bd');
        $this->addSql('DROP TABLE user_comic');
        $this->addSql('DROP TABLE user_manga');
        $this->addSql('DROP TABLE user_cd');
        $this->addSql('DROP TABLE user_lp');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
