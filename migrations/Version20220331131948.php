<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220331131948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function isTransactional(): bool
    {
        return false;
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE hall (id INT AUTO_INCREMENT NOT NULL, total_seats INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, duration_minutes INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, movie_id INT DEFAULT NULL, hall_id INT DEFAULT NULL, start_at DATETIME NOT NULL, INDEX IDX_D044D5D48F93B6FC (movie_id), INDEX IDX_D044D5D452AFCFD6 (hall_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D48F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D452AFCFD6 FOREIGN KEY (hall_id) REFERENCES hall (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D452AFCFD6');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D48F93B6FC');
        $this->addSql('DROP TABLE hall');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE session');
    }
}
