<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230407134659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_tutorial (category_id VARCHAR(255) NOT NULL, tutorial_id VARCHAR(255) NOT NULL, INDEX IDX_71117B9212469DE2 (category_id), INDEX IDX_71117B9289366B7B (tutorial_id), PRIMARY KEY(category_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_subject (category_id VARCHAR(255) NOT NULL, subject_id VARCHAR(255) NOT NULL, INDEX IDX_3C167E0412469DE2 (category_id), INDEX IDX_3C167E0423EDC87 (subject_id), PRIMARY KEY(category_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_subject (id VARCHAR(255) NOT NULL, users_id VARCHAR(255) DEFAULT NULL, subject_id VARCHAR(255) DEFAULT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_5F6FA20967B3B43D (users_id), INDEX IDX_5F6FA20923EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_tutorial (id VARCHAR(255) NOT NULL, users_id VARCHAR(255) DEFAULT NULL, tutorial_id VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_FC37EF367B3B43D (users_id), INDEX IDX_FC37EF389366B7B (tutorial_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id VARCHAR(255) NOT NULL, profile_id VARCHAR(255) NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9289366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0423EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA20967B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA20923EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF367B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF389366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9212469DE2');
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9289366B7B');
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0412469DE2');
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0423EDC87');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA20967B3B43D');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA20923EDC87');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF367B3B43D');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF389366B7B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649CCFA12B8');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_tutorial');
        $this->addSql('DROP TABLE category_subject');
        $this->addSql('DROP TABLE commentary_subject');
        $this->addSql('DROP TABLE commentary_tutorial');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE tutorial');
        $this->addSql('DROP TABLE user');
    }
}
