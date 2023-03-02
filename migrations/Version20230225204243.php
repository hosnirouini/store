<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230225204243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE colors (id INT AUTO_INCREMENT NOT NULL, colorname VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_colors (product_id INT NOT NULL, colors_id INT NOT NULL, INDEX IDX_A0C2823B4584665A (product_id), INDEX IDX_A0C2823B5C002039 (colors_id), PRIMARY KEY(product_id, colors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_colors ADD CONSTRAINT FK_A0C2823B4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_colors ADD CONSTRAINT FK_A0C2823B5C002039 FOREIGN KEY (colors_id) REFERENCES colors (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_colors DROP FOREIGN KEY FK_A0C2823B4584665A');
        $this->addSql('ALTER TABLE product_colors DROP FOREIGN KEY FK_A0C2823B5C002039');
        $this->addSql('DROP TABLE colors');
        $this->addSql('DROP TABLE product_colors');
    }
}
