<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223095645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, begindate DATE DEFAULT NULL, enddate DATE DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers_product (offers_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_BABA2405A090B42E (offers_id), INDEX IDX_BABA24054584665A (product_id), PRIMARY KEY(offers_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offers_product ADD CONSTRAINT FK_BABA2405A090B42E FOREIGN KEY (offers_id) REFERENCES offers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offers_product ADD CONSTRAINT FK_BABA24054584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE productimages ADD CONSTRAINT FK_CB7B29AA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offers_product DROP FOREIGN KEY FK_BABA2405A090B42E');
        $this->addSql('ALTER TABLE offers_product DROP FOREIGN KEY FK_BABA24054584665A');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE offers_product');
        $this->addSql('ALTER TABLE productimages DROP FOREIGN KEY FK_CB7B29AA4584665A');
    }
}
