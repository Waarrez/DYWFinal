<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622151947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_tutorial (category_id VARCHAR(255) NOT NULL, tutorial_id VARCHAR(255) NOT NULL, INDEX IDX_71117B9212469DE2 (category_id), INDEX IDX_71117B9289366B7B (tutorial_id), PRIMARY KEY(category_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_subject (category_id VARCHAR(255) NOT NULL, subject_id VARCHAR(255) NOT NULL, INDEX IDX_3C167E0412469DE2 (category_id), INDEX IDX_3C167E0423EDC87 (subject_id), PRIMARY KEY(category_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_subject (commentary_id VARCHAR(255) NOT NULL, subject_id VARCHAR(255) NOT NULL, INDEX IDX_5F6FA2095DED49AA (commentary_id), INDEX IDX_5F6FA20923EDC87 (subject_id), PRIMARY KEY(commentary_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9289366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0423EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA2095DED49AA FOREIGN KEY (commentary_id) REFERENCES commentary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA20923EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9212469DE2');
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9289366B7B');
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0412469DE2');
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0423EDC87');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA2095DED49AA');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA20923EDC87');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_tutorial');
        $this->addSql('DROP TABLE category_subject');
        $this->addSql('DROP TABLE commentary_subject');
        $this->addSql('DROP TABLE subject');
    }
}
