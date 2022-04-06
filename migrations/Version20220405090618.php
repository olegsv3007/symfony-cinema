<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220405090618 extends AbstractMigration
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
        $this->addSql('ALTER TABLE session ADD movie_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', ADD hall_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D48F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D452AFCFD6 FOREIGN KEY (hall_id) REFERENCES hall (id)');
        $this->addSql('CREATE INDEX IDX_D044D5D48F93B6FC ON session (movie_id)');
        $this->addSql('CREATE INDEX IDX_D044D5D452AFCFD6 ON session (hall_id)');
        $this->addSql('ALTER TABLE ticket ADD session_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3613FECDF ON ticket (session_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D48F93B6FC');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D452AFCFD6');
        $this->addSql('DROP INDEX IDX_D044D5D48F93B6FC ON session');
        $this->addSql('DROP INDEX IDX_D044D5D452AFCFD6 ON session');
        $this->addSql('ALTER TABLE session DROP movie_id, DROP hall_id');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3613FECDF');
        $this->addSql('DROP INDEX IDX_97A0ADA3613FECDF ON ticket');
        $this->addSql('ALTER TABLE ticket DROP session_id');
    }
}
