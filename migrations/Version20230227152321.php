<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227152321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE topsellers (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topsellers_product (topsellers_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_B1A5E20A2AA4A619 (topsellers_id), INDEX IDX_B1A5E20A4584665A (product_id), PRIMARY KEY(topsellers_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE topsellers_product ADD CONSTRAINT FK_B1A5E20A2AA4A619 FOREIGN KEY (topsellers_id) REFERENCES topsellers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE topsellers_product ADD CONSTRAINT FK_B1A5E20A4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE topsellers_product DROP FOREIGN KEY FK_B1A5E20A2AA4A619');
        $this->addSql('ALTER TABLE topsellers_product DROP FOREIGN KEY FK_B1A5E20A4584665A');
        $this->addSql('DROP TABLE topsellers');
        $this->addSql('DROP TABLE topsellers_product');
    }
}
