<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230317141926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asso_address_event (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, commune VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_events (id INT AUTO_INCREMENT NOT NULL, asso_profile_id INT DEFAULT NULL, address_id INT DEFAULT NULL, event VARCHAR(255) NOT NULL, event_date DATETIME NOT NULL, presential TINYINT(1) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_109EE43F23D6BB6D (asso_profile_id), UNIQUE INDEX UNIQ_109EE43FF5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_members (id INT AUTO_INCREMENT NOT NULL, asso_profile_id INT DEFAULT NULL, members_role_id INT DEFAULT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, INDEX IDX_658C4EFF23D6BB6D (asso_profile_id), UNIQUE INDEX UNIQ_658C4EFF3153118C (members_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_members_role (id INT AUTO_INCREMENT NOT NULL, asso_profile_admin TINYINT(1) NOT NULL, asso_members VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE asso_profile (id INT AUTO_INCREMENT NOT NULL, asso_role_id INT DEFAULT NULL, association_name VARCHAR(255) NOT NULL, registred VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, commune VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_A17B360FF62FBEAC (asso_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_staus (id INT AUTO_INCREMENT NOT NULL, published TINYINT(1) DEFAULT NULL, draft TINYINT(1) DEFAULT NULL, on_hold TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, teacher_profile_id INT DEFAULT NULL, status_id INT DEFAULT NULL, categories_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT NOT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_169E6FB946E5B018 (teacher_profile_id), UNIQUE INDEX UNIQ_169E6FB96BF700BD (status_id), INDEX IDX_169E6FB9A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_comments (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, course_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_F62AFB7CF675F31B (author_id), INDEX IDX_F62AFB7C591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_answers (id INT AUTO_INCREMENT NOT NULL, questions_id INT NOT NULL, answers LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A11C8B77BCB134CE (questions_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forum_questions (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, questions LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', author VARCHAR(255) NOT NULL, INDEX IDX_B495D083A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parent_profile (id INT AUTO_INCREMENT NOT NULL, parent_role_id INT DEFAULT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_F31FDE49A44B56EA (parent_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, teacher TINYINT(1) DEFAULT NULL, parent TINYINT(1) DEFAULT NULL, asso TINYINT(1) DEFAULT NULL, INDEX IDX_B63E2EC7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher_profile (id INT AUTO_INCREMENT NOT NULL, teacher_role_id INT DEFAULT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, registred VARCHAR(255) NOT NULL, teaching_level VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, INDEX IDX_4C95274E1BC1AFED (teacher_role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE asso_events ADD CONSTRAINT FK_109EE43F23D6BB6D FOREIGN KEY (asso_profile_id) REFERENCES asso_profile (id)');
        $this->addSql('ALTER TABLE asso_events ADD CONSTRAINT FK_109EE43FF5B7AF75 FOREIGN KEY (address_id) REFERENCES asso_address_event (id)');
        $this->addSql('ALTER TABLE asso_members ADD CONSTRAINT FK_658C4EFF23D6BB6D FOREIGN KEY (asso_profile_id) REFERENCES asso_profile (id)');
        $this->addSql('ALTER TABLE asso_members ADD CONSTRAINT FK_658C4EFF3153118C FOREIGN KEY (members_role_id) REFERENCES asso_members_role (id)');
        $this->addSql('ALTER TABLE asso_profile ADD CONSTRAINT FK_A17B360FF62FBEAC FOREIGN KEY (asso_role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB946E5B018 FOREIGN KEY (teacher_profile_id) REFERENCES teacher_profile (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB96BF700BD FOREIGN KEY (status_id) REFERENCES content_staus (id)');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB9A21214B7 FOREIGN KEY (categories_id) REFERENCES course_category (id)');
        $this->addSql('ALTER TABLE course_comments ADD CONSTRAINT FK_F62AFB7CF675F31B FOREIGN KEY (author_id) REFERENCES parent_profile (id)');
        $this->addSql('ALTER TABLE course_comments ADD CONSTRAINT FK_F62AFB7C591CC992 FOREIGN KEY (course_id) REFERENCES course (id)');
        $this->addSql('ALTER TABLE forum_answers ADD CONSTRAINT FK_A11C8B77BCB134CE FOREIGN KEY (questions_id) REFERENCES forum_questions (id)');
        $this->addSql('ALTER TABLE forum_questions ADD CONSTRAINT FK_B495D083A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE parent_profile ADD CONSTRAINT FK_F31FDE49A44B56EA FOREIGN KEY (parent_role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE teacher_profile ADD CONSTRAINT FK_4C95274E1BC1AFED FOREIGN KEY (teacher_role_id) REFERENCES roles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE asso_events DROP FOREIGN KEY FK_109EE43F23D6BB6D');
        $this->addSql('ALTER TABLE asso_events DROP FOREIGN KEY FK_109EE43FF5B7AF75');
        $this->addSql('ALTER TABLE asso_members DROP FOREIGN KEY FK_658C4EFF23D6BB6D');
        $this->addSql('ALTER TABLE asso_members DROP FOREIGN KEY FK_658C4EFF3153118C');
        $this->addSql('ALTER TABLE asso_profile DROP FOREIGN KEY FK_A17B360FF62FBEAC');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB946E5B018');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB96BF700BD');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB9A21214B7');
        $this->addSql('ALTER TABLE course_comments DROP FOREIGN KEY FK_F62AFB7CF675F31B');
        $this->addSql('ALTER TABLE course_comments DROP FOREIGN KEY FK_F62AFB7C591CC992');
        $this->addSql('ALTER TABLE forum_answers DROP FOREIGN KEY FK_A11C8B77BCB134CE');
        $this->addSql('ALTER TABLE forum_questions DROP FOREIGN KEY FK_B495D083A76ED395');
        $this->addSql('ALTER TABLE parent_profile DROP FOREIGN KEY FK_F31FDE49A44B56EA');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC7A76ED395');
        $this->addSql('ALTER TABLE teacher_profile DROP FOREIGN KEY FK_4C95274E1BC1AFED');
        $this->addSql('DROP TABLE asso_address_event');
        $this->addSql('DROP TABLE asso_events');
        $this->addSql('DROP TABLE asso_members');
        $this->addSql('DROP TABLE asso_members_role');
        $this->addSql('DROP TABLE asso_profile');
        $this->addSql('DROP TABLE content_staus');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_category');
        $this->addSql('DROP TABLE course_comments');
        $this->addSql('DROP TABLE forum_answers');
        $this->addSql('DROP TABLE forum_questions');
        $this->addSql('DROP TABLE parent_profile');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE teacher_profile');
        $this->addSql('DROP TABLE user');
    }
}
