<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215141347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE material (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(20) NOT NULL, STOCK INT NOT NULL, ARMARIO INT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva_material (CANTIDAD INT NOT NULL, FECHA_RESERVA VARCHAR(255) NOT NULL, FECHA_DEVOLUCION DATE NOT NULL, ESTADO VARCHAR(15) NOT NULL, ID_USUARIO INT NOT NULL, ID_MATERIAL INT NOT NULL, INDEX IDX_14A2155AE116644 (ID_USUARIO), INDEX IDX_14A2155A2397894B (ID_MATERIAL), PRIMARY KEY(ID_USUARIO, ID_MATERIAL, FECHA_RESERVA)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sala (NOMBRE_SALA INT NOT NULL, FECHA_RESERVA DATETIME DEFAULT NULL, ESTADO VARCHAR(20) NOT NULL, ID_USUARIO INT DEFAULT NULL, INDEX IDX_E226041CE116644 (ID_USUARIO), PRIMARY KEY(NOMBRE_SALA)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (ID INT AUTO_INCREMENT NOT NULL, NOMBRE_USUARIO VARCHAR(20) NOT NULL, CONTRASEÑA VARCHAR(20) NOT NULL, CORREO VARCHAR(30) NOT NULL, PRIVILEGIO VARCHAR(20) NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva_material ADD CONSTRAINT FK_14A2155AE116644 FOREIGN KEY (ID_USUARIO) REFERENCES usuario (ID)');
        $this->addSql('ALTER TABLE reserva_material ADD CONSTRAINT FK_14A2155A2397894B FOREIGN KEY (ID_MATERIAL) REFERENCES material (ID)');
        $this->addSql('ALTER TABLE sala ADD CONSTRAINT FK_E226041CE116644 FOREIGN KEY (ID_USUARIO) REFERENCES usuario (ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva_material DROP FOREIGN KEY FK_14A2155AE116644');
        $this->addSql('ALTER TABLE reserva_material DROP FOREIGN KEY FK_14A2155A2397894B');
        $this->addSql('ALTER TABLE sala DROP FOREIGN KEY FK_E226041CE116644');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE reserva_material');
        $this->addSql('DROP TABLE sala');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
