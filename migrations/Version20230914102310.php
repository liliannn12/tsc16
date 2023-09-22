<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230914102310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_images DROP FOREIGN KEY FK_8AD829EAD44F05E5');
        $this->addSql('ALTER TABLE article_images DROP FOREIGN KEY FK_8AD829EA7294869C');
        $this->addSql('ALTER TABLE category_images DROP FOREIGN KEY FK_EFF7741112469DE2');
        $this->addSql('ALTER TABLE category_images DROP FOREIGN KEY FK_EFF77411D44F05E5');
        $this->addSql('DROP TABLE article_images');
        $this->addSql('DROP TABLE category_images');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_images (article_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_8AD829EAD44F05E5 (images_id), INDEX IDX_8AD829EA7294869C (article_id), PRIMARY KEY(article_id, images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category_images (category_id INT NOT NULL, images_id INT NOT NULL, INDEX IDX_EFF7741112469DE2 (category_id), INDEX IDX_EFF77411D44F05E5 (images_id), PRIMARY KEY(category_id, images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_images ADD CONSTRAINT FK_8AD829EAD44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_images ADD CONSTRAINT FK_8AD829EA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_images ADD CONSTRAINT FK_EFF7741112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_images ADD CONSTRAINT FK_EFF77411D44F05E5 FOREIGN KEY (images_id) REFERENCES images (id) ON DELETE CASCADE');
    }
}
