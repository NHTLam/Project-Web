<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616072933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback ADD assigment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D229445871752335 FOREIGN KEY (assigment_id) REFERENCES assignment (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D229445871752335 ON feedback (assigment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D229445871752335');
        $this->addSql('DROP INDEX UNIQ_D229445871752335 ON feedback');
        $this->addSql('ALTER TABLE feedback DROP assigment_id');
    }
}
