<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211195733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, productimages_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6A313F2A12 (productimages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE productimages (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, INDEX IDX_CB7B29AA4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A313F2A12 FOREIGN KEY (productimages_id) REFERENCES productimages (id)');
        $this->addSql('ALTER TABLE productimages ADD CONSTRAINT FK_CB7B29AA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD createdat DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD createdat DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A313F2A12');
        $this->addSql('ALTER TABLE productimages DROP FOREIGN KEY FK_CB7B29AA4584665A');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE productimages');
        $this->addSql('ALTER TABLE product DROP createdat');
        $this->addSql('ALTER TABLE user DROP createdat');
    }
}
