<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613111811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', name VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_subject (category_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', subject_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', INDEX IDX_3C167E0412469DE2 (category_id), INDEX IDX_3C167E0423EDC87 (subject_id), PRIMARY KEY(category_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_tutorial (category_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', tutorial_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', INDEX IDX_71117B9212469DE2 (category_id), INDEX IDX_71117B9289366B7B (tutorial_id), PRIMARY KEY(category_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', users_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1CAC12CA67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_tutorial (commentary_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', tutorial_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', INDEX IDX_FC37EF35DED49AA (commentary_id), INDEX IDX_FC37EF389366B7B (tutorial_id), PRIMARY KEY(commentary_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_subject (commentary_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', subject_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', INDEX IDX_5F6FA2095DED49AA (commentary_id), INDEX IDX_5F6FA20923EDC87 (subject_id), PRIMARY KEY(commentary_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, users_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0F67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', users_id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FBCE3E7A67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', users_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, url VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C66BFFE967B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0412469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_subject ADD CONSTRAINT FK_3C167E0423EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_tutorial ADD CONSTRAINT FK_71117B9289366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF35DED49AA FOREIGN KEY (commentary_id) REFERENCES commentary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF389366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA2095DED49AA FOREIGN KEY (commentary_id) REFERENCES commentary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_subject ADD CONSTRAINT FK_5F6FA20923EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tutorial ADD CONSTRAINT FK_C66BFFE967B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0412469DE2');
        $this->addSql('ALTER TABLE category_subject DROP FOREIGN KEY FK_3C167E0423EDC87');
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9212469DE2');
        $this->addSql('ALTER TABLE category_tutorial DROP FOREIGN KEY FK_71117B9289366B7B');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA67B3B43D');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF35DED49AA');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF389366B7B');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA2095DED49AA');
        $this->addSql('ALTER TABLE commentary_subject DROP FOREIGN KEY FK_5F6FA20923EDC87');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F67B3B43D');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A67B3B43D');
        $this->addSql('ALTER TABLE tutorial DROP FOREIGN KEY FK_C66BFFE967B3B43D');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_subject');
        $this->addSql('DROP TABLE category_tutorial');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE commentary_tutorial');
        $this->addSql('DROP TABLE commentary_subject');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE subject');
        $this->addSql('DROP TABLE tutorial');
        $this->addSql('DROP TABLE user');
    }
}
