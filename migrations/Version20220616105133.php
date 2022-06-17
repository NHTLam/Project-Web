<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616105133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE courses_lectures (courses_id INT NOT NULL, lectures_id INT NOT NULL, INDEX IDX_9AC88742F9295384 (courses_id), INDEX IDX_9AC88742291E007 (lectures_id), PRIMARY KEY(courses_id, lectures_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE courses_lectures ADD CONSTRAINT FK_9AC88742F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_lectures ADD CONSTRAINT FK_9AC88742291E007 FOREIGN KEY (lectures_id) REFERENCES lectures (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE courses_lectures');
    }
}
