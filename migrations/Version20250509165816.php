<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509165816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE user_course (id INT AUTO_INCREMENT NOT NULL, started_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_course_user (user_course_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_EC2AC2DA59FC4476 (user_course_id), INDEX IDX_EC2AC2DAA76ED395 (user_id), PRIMARY KEY(user_course_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_course_course (user_course_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_562803A459FC4476 (user_course_id), INDEX IDX_562803A4591CC992 (course_id), PRIMARY KEY(user_course_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_user ADD CONSTRAINT FK_EC2AC2DA59FC4476 FOREIGN KEY (user_course_id) REFERENCES user_course (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_user ADD CONSTRAINT FK_EC2AC2DAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_course ADD CONSTRAINT FK_562803A459FC4476 FOREIGN KEY (user_course_id) REFERENCES user_course (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_course ADD CONSTRAINT FK_562803A4591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_user DROP FOREIGN KEY FK_EC2AC2DA59FC4476
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_user DROP FOREIGN KEY FK_EC2AC2DAA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_course DROP FOREIGN KEY FK_562803A459FC4476
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_course_course DROP FOREIGN KEY FK_562803A4591CC992
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_course
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_course_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_course_course
        SQL);
    }
}
