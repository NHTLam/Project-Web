<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616140516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D229445871752335');
        $this->addSql('DROP INDEX UNIQ_D229445871752335 ON feedback');
        $this->addSql('ALTER TABLE feedback CHANGE assigment_id assignment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D2294458D19302F8 ON feedback (assignment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458D19302F8');
        $this->addSql('DROP INDEX UNIQ_D2294458D19302F8 ON feedback');
        $this->addSql('ALTER TABLE feedback CHANGE assignment_id assigment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D229445871752335 FOREIGN KEY (assigment_id) REFERENCES assignment (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D229445871752335 ON feedback (assigment_id)');
    }
}
