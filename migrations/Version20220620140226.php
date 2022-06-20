<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220620140226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_q (id INT AUTO_INCREMENT NOT NULL, assignment_id INT DEFAULT NULL, answer VARCHAR(255) NOT NULL, datesubmit DATE NOT NULL, UNIQUE INDEX UNIQ_2502B07AD19302F8 (assignment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_q ADD CONSTRAINT FK_2502B07AD19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('DROP TABLE submit');
        $this->addSql('ALTER TABLE assignment ADD answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE assignment ADD CONSTRAINT FK_30C544BAAA334807 FOREIGN KEY (answer_id) REFERENCES answer_q (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30C544BAAA334807 ON assignment (answer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assignment DROP FOREIGN KEY FK_30C544BAAA334807');
        $this->addSql('CREATE TABLE submit (id INT AUTO_INCREMENT NOT NULL, assignment_id INT DEFAULT NULL, answer VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, datesubmit DATE NOT NULL, UNIQUE INDEX UNIQ_3F31B343D19302F8 (assignment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE submit ADD CONSTRAINT FK_3F31B343D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('DROP TABLE answer_q');
        $this->addSql('DROP INDEX UNIQ_30C544BAAA334807 ON assignment');
        $this->addSql('ALTER TABLE assignment DROP answer_id');
    }
}
