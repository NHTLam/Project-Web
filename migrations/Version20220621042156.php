<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621042156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE assignment DROP FOREIGN KEY FK_30C544BAAA334807');
        $this->addSql('DROP TABLE answer_q');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP INDEX UNIQ_30C544BAAA334807 ON assignment');
        $this->addSql('ALTER TABLE assignment ADD answer VARCHAR(255) DEFAULT NULL, ADD datesubmit DATE DEFAULT NULL, ADD grade DOUBLE PRECISION DEFAULT NULL, ADD comment VARCHAR(255) DEFAULT NULL, ADD datefeedback DATE DEFAULT NULL, DROP answer_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_q (id INT AUTO_INCREMENT NOT NULL, assignment_id INT DEFAULT NULL, answer VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, datesubmit DATE NOT NULL, UNIQUE INDEX UNIQ_2502B07AD19302F8 (assignment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, assignment_id INT DEFAULT NULL, grade DOUBLE PRECISION NOT NULL, comment VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_feedback DATE NOT NULL, UNIQUE INDEX UNIQ_D2294458D19302F8 (assignment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE answer_q ADD CONSTRAINT FK_2502B07AD19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('ALTER TABLE assignment ADD answer_id INT DEFAULT NULL, DROP answer, DROP datesubmit, DROP grade, DROP comment, DROP datefeedback');
        $this->addSql('ALTER TABLE assignment ADD CONSTRAINT FK_30C544BAAA334807 FOREIGN KEY (answer_id) REFERENCES answer_q (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30C544BAAA334807 ON assignment (answer_id)');
    }
}
