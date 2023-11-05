<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231105010448 extends AbstractMigration
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
        $this->addSql('CREATE TABLE commentary (id VARCHAR(255) NOT NULL, users_id VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_1CAC12CA67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_tutorial (commentary_id VARCHAR(255) NOT NULL, tutorial_id VARCHAR(255) NOT NULL, INDEX IDX_FC37EF35DED49AA (commentary_id), INDEX IDX_FC37EF389366B7B (tutorial_id), PRIMARY KEY(commentary_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_subject (commentary_id VARCHAR(255) NOT NULL, subject_id VARCHAR(255) NOT NULL, INDEX IDX_5F6FA2095DED49AA (commentary_id), INDEX IDX_5F6FA20923EDC87 (subject_id), PRIMARY KEY(commentary_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id VARCHAR(255) NOT NULL, users_id VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0F67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id VARCHAR(255) NOT NULL, users_id VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FBCE3E7A67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, url VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9289366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0423EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF35DED49AA FOREIGN KEY (commentary_id) REFERENCES commentary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF389366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA2095DED49AA FOREIGN KEY (commentary_id) REFERENCES commentary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA20923EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9212469DE2');
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9289366B7B');
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0412469DE2');
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0423EDC87');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA67B3B43D');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF35DED49AA');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF389366B7B');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA2095DED49AA');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA20923EDC87');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F67B3B43D');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A67B3B43D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_tutorial');
        $this->addSql('DROP TABLE category_subject');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE commentary_tutorial');
        $this->addSql('DROP TABLE commentary_subject');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE tutorial');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
