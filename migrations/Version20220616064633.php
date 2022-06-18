<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616064633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE assignment (id INT AUTO_INCREMENT NOT NULL, date_submit DATE NOT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, grade DOUBLE PRECISION NOT NULL, comment VARCHAR(255) NOT NULL, date_feedback DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE major (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, course INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, assignment_id INT DEFAULT NULL, major_id INT DEFAULT NULL, name VARCHAR(30) NOT NULL, gender VARCHAR(10) NOT NULL, birthdate DATE NOT NULL, address VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_B723AF33D19302F8 (assignment_id), INDEX IDX_B723AF33E93695C7 (major_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33D19302F8 FOREIGN KEY (assignment_id) REFERENCES assignment (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33E93695C7 FOREIGN KEY (major_id) REFERENCES major (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33D19302F8');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33E93695C7');
        $this->addSql('DROP TABLE assignment');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE major');
        $this->addSql('DROP TABLE student');
    }
}
