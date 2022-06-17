<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220616034044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, std_quantity INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, duration INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses_classes (courses_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_BBD48359F9295384 (courses_id), INDEX IDX_BBD483599E225B24 (classes_id), PRIMARY KEY(courses_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lectures (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lectures_classes (lectures_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_7E503FB1291E007 (lectures_id), INDEX IDX_7E503FB19E225B24 (classes_id), PRIMARY KEY(lectures_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lectures_courses (lectures_id INT NOT NULL, courses_id INT NOT NULL, INDEX IDX_D5181B38291E007 (lectures_id), INDEX IDX_D5181B38F9295384 (courses_id), PRIMARY KEY(lectures_id, courses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, classes_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_B723AF339E225B24 (classes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_courses (student_id INT NOT NULL, courses_id INT NOT NULL, INDEX IDX_4493EFB4CB944F1A (student_id), INDEX IDX_4493EFB4F9295384 (courses_id), PRIMARY KEY(student_id, courses_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE courses_classes ADD CONSTRAINT FK_BBD48359F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_classes ADD CONSTRAINT FK_BBD483599E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectures_classes ADD CONSTRAINT FK_7E503FB1291E007 FOREIGN KEY (lectures_id) REFERENCES lectures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectures_classes ADD CONSTRAINT FK_7E503FB19E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectures_courses ADD CONSTRAINT FK_D5181B38291E007 FOREIGN KEY (lectures_id) REFERENCES lectures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectures_courses ADD CONSTRAINT FK_D5181B38F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE student_courses ADD CONSTRAINT FK_4493EFB4CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_courses ADD CONSTRAINT FK_4493EFB4F9295384 FOREIGN KEY (courses_id) REFERENCES courses (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courses_classes DROP FOREIGN KEY FK_BBD483599E225B24');
        $this->addSql('ALTER TABLE lectures_classes DROP FOREIGN KEY FK_7E503FB19E225B24');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339E225B24');
        $this->addSql('ALTER TABLE courses_classes DROP FOREIGN KEY FK_BBD48359F9295384');
        $this->addSql('ALTER TABLE lectures_courses DROP FOREIGN KEY FK_D5181B38F9295384');
        $this->addSql('ALTER TABLE student_courses DROP FOREIGN KEY FK_4493EFB4F9295384');
        $this->addSql('ALTER TABLE lectures_classes DROP FOREIGN KEY FK_7E503FB1291E007');
        $this->addSql('ALTER TABLE lectures_courses DROP FOREIGN KEY FK_D5181B38291E007');
        $this->addSql('ALTER TABLE student_courses DROP FOREIGN KEY FK_4493EFB4CB944F1A');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE courses_classes');
        $this->addSql('DROP TABLE lectures');
        $this->addSql('DROP TABLE lectures_classes');
        $this->addSql('DROP TABLE lectures_courses');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_courses');
    }
}
