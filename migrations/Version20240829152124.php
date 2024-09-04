<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240829152124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture ADD zoo_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89FA5C94EF FOREIGN KEY (zoo_id) REFERENCES zoo (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F89FA5C94EF ON picture (zoo_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89FA5C94EF');
        $this->addSql('DROP INDEX IDX_16DB4F89FA5C94EF ON picture');
        $this->addSql('ALTER TABLE picture DROP zoo_id');
    }
}
