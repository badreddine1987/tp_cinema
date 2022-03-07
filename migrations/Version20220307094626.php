<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220307094626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE film_artiste');
        $this->addSql('ALTER TABLE film ADD realisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE film ADD CONSTRAINT FK_8244BE22F1D8422E FOREIGN KEY (realisateur_id) REFERENCES artiste (id)');
        $this->addSql('CREATE INDEX IDX_8244BE22F1D8422E ON film (realisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_artiste (film_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_7CB92E6C567F5183 (film_id), INDEX IDX_7CB92E6C21D25844 (artiste_id), PRIMARY KEY(film_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE film_artiste ADD CONSTRAINT FK_7CB92E6C21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_artiste ADD CONSTRAINT FK_7CB92E6C567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artiste CHANGE nom nom VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE photo photo VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categorie CHANGE nom nom VARCHAR(120) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE film DROP FOREIGN KEY FK_8244BE22F1D8422E');
        $this->addSql('DROP INDEX IDX_8244BE22F1D8422E ON film');
        $this->addSql('ALTER TABLE film DROP realisateur_id, CHANGE titre titre VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
