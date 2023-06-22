<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622150120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentary (id VARCHAR(255) NOT NULL, users_id VARCHAR(255) DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_1CAC12CA67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary_tutorial (commentary_id VARCHAR(255) NOT NULL, tutorial_id VARCHAR(255) NOT NULL, INDEX IDX_FC37EF35DED49AA (commentary_id), INDEX IDX_FC37EF389366B7B (tutorial_id), PRIMARY KEY(commentary_id, tutorial_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutorial (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, url VARCHAR(255) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF35DED49AA FOREIGN KEY (commentary_id) REFERENCES commentary (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentary_tutorial ADD CONSTRAINT FK_FC37EF389366B7B FOREIGN KEY (tutorial_id) REFERENCES tutorial (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA67B3B43D');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF35DED49AA');
        $this->addSql('ALTER TABLE commentary_tutorial DROP FOREIGN KEY FK_FC37EF389366B7B');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE commentary_tutorial');
        $this->addSql('DROP TABLE tutorial');
    }
}
