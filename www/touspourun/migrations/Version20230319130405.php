<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230319130405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asso_adress_events (id INT AUTO_INCREMENT NOT NULL, adress VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, common VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_events (id INT AUTO_INCREMENT NOT NULL, asso_adress_events_id INT DEFAULT NULL, event VARCHAR(255) NOT NULL, date DATETIME NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_109EE43FDBFB20FE (asso_adress_events_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_members (id INT AUTO_INCREMENT NOT NULL, profil_id INT NOT NULL, llast_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, INDEX IDX_658C4EFF275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_members_role (id INT AUTO_INCREMENT NOT NULL, asso_members_id INT NOT NULL, asso_role_admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_4B466FF5522D5C38 (asso_members_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_categories (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_E51108EB591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_comments (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', author VARCHAR(255) NOT NULL, INDEX IDX_F62AFB7C591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_status (id INT AUTO_INCREMENT NOT NULL, course_id INT NOT NULL, published TINYINT(1) NOT NULL, draft TINYINT(1) NOT NULL, on_hold TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_D538A451591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_answers (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, answers LONGTEXT NOT NULL, INDEX IDX_A11C8B771E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_questions (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, questions LONGTEXT NOT NULL, INDEX IDX_B495D083F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, teatching_level LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', siret VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, common VARCHAR(255) NOT NULL, asso_name VARCHAR(255) NOT NULL, registred VARCHAR(255) NOT NULL, INDEX IDX_E6D6B297A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, profil_id INT NOT NULL, registred VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7B00651C275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asso_events ADD CONSTRAINT FK_109EE43FDBFB20FE FOREIGN KEY (asso_adress_events_id) REFERENCES asso_adress_events (id)');
        $this->addSql('ALTER TABLE asso_members ADD CONSTRAINT FK_658C4EFF275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE asso_members_role ADD CONSTRAINT FK_4B466FF5522D5C38 FOREIGN KEY (asso_members_id) REFERENCES asso_members (id)');
        $this->addSql('ALTER TABLE course_categories ADD CONSTRAINT FK_E51108EB591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_comments ADD CONSTRAINT FK_F62AFB7C591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE course_status ADD CONSTRAINT FK_D538A451591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE forum_answers ADD CONSTRAINT FK_A11C8B771E27F6BF FOREIGN KEY (question_id) REFERENCES forum_questions (id)');
        $this->addSql('ALTER TABLE forum_questions ADD CONSTRAINT FK_B495D083F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B297A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651C275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asso_events DROP FOREIGN KEY FK_109EE43FDBFB20FE');
        $this->addSql('ALTER TABLE asso_members DROP FOREIGN KEY FK_658C4EFF275ED078');
        $this->addSql('ALTER TABLE asso_members_role DROP FOREIGN KEY FK_4B466FF5522D5C38');
        $this->addSql('ALTER TABLE course_categories DROP FOREIGN KEY FK_E51108EB591CC992');
        $this->addSql('ALTER TABLE course_comments DROP FOREIGN KEY FK_F62AFB7C591CC992');
        $this->addSql('ALTER TABLE course_status DROP FOREIGN KEY FK_D538A451591CC992');
        $this->addSql('ALTER TABLE forum_answers DROP FOREIGN KEY FK_A11C8B771E27F6BF');
        $this->addSql('ALTER TABLE forum_questions DROP FOREIGN KEY FK_B495D083F675F31B');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B297A76ED395');
        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651C275ED078');
        $this->addSql('DROP TABLE asso_adress_events');
        $this->addSql('DROP TABLE asso_events');
        $this->addSql('DROP TABLE asso_members');
        $this->addSql('DROP TABLE asso_members_role');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_categories');
        $this->addSql('DROP TABLE course_comments');
        $this->addSql('DROP TABLE course_status');
        $this->addSql('DROP TABLE forum_answers');
        $this->addSql('DROP TABLE forum_questions');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE user');
    }
}
