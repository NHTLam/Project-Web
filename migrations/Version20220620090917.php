<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620090917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE submit (id INT AUTO_INCREMENT NOT NULL, assignment_id INT DEFAULT NULL, answer VARCHAR(255) NOT NULL, datesubmit DATE NOT NULL, UNIQUE INDEX UNIQ_3F31B343D19302F8 (assignment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE submit ADD CONSTRAINT FK_3F31B343D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('ALTER TABLE assignment CHANGE date_submit deadline DATE NOT NULL, CHANGE file question VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE submit');
        $this->addSql('ALTER TABLE assignment CHANGE deadline date_submit DATE NOT NULL, CHANGE question file VARCHAR(255) NOT NULL');
    }
}
