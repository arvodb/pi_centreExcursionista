<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219083654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE material (ID INT AUTO_INCREMENT NOT NULL, NOMBRE VARCHAR(255) NOT NULL, STOCK INT NOT NULL, ARMARIO INT NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva_material (CANTIDAD INT NOT NULL, FECHA_RESERVA VARCHAR(255) NOT NULL, FECHA_DEVOLUCION DATE NOT NULL, ESTADO VARCHAR(15) NOT NULL, ID_USUARIO INT NOT NULL, ID_MATERIAL INT NOT NULL, INDEX IDX_14A2155AE116644 (ID_USUARIO), INDEX IDX_14A2155A2397894B (ID_MATERIAL), PRIMARY KEY(ID_USUARIO, ID_MATERIAL, FECHA_RESERVA)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reserva_sala (FECHA_RESERVA VARCHAR(20) NOT NULL, HORARIO VARCHAR(20) NOT NULL, ID_USUARIO INT NOT NULL, NUMERO_SALA INT NOT NULL, INDEX IDX_42E93517E116644 (ID_USUARIO), INDEX IDX_42E93517FBD4C859 (NUMERO_SALA), PRIMARY KEY(FECHA_RESERVA, ID_USUARIO, HORARIO, NUMERO_SALA)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sala (NUMERO_SALA INT NOT NULL, PRIMARY KEY(NUMERO_SALA)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE total_reservas (NOMBRE VARCHAR(20) NOT NULL, TOTAL INT NOT NULL, PRIMARY KEY(NOMBRE)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (ID INT AUTO_INCREMENT NOT NULL, NOMBRE_USUARIO VARCHAR(20) NOT NULL, CONTRASEÑA VARCHAR(20) NOT NULL, CORREO VARCHAR(30) NOT NULL, PRIVILEGIO VARCHAR(20) NOT NULL, PRIMARY KEY(ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reserva_material ADD CONSTRAINT FK_14A2155AE116644 FOREIGN KEY (ID_USUARIO) REFERENCES usuario (ID)');
        $this->addSql('ALTER TABLE reserva_material ADD CONSTRAINT FK_14A2155A2397894B FOREIGN KEY (ID_MATERIAL) REFERENCES material (ID)');
        $this->addSql('ALTER TABLE reserva_sala ADD CONSTRAINT FK_42E93517E116644 FOREIGN KEY (ID_USUARIO) REFERENCES usuario (ID)');
        $this->addSql('ALTER TABLE reserva_sala ADD CONSTRAINT FK_42E93517FBD4C859 FOREIGN KEY (NUMERO_SALA) REFERENCES sala (NUMERO_SALA)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reserva_material DROP FOREIGN KEY FK_14A2155AE116644');
        $this->addSql('ALTER TABLE reserva_material DROP FOREIGN KEY FK_14A2155A2397894B');
        $this->addSql('ALTER TABLE reserva_sala DROP FOREIGN KEY FK_42E93517E116644');
        $this->addSql('ALTER TABLE reserva_sala DROP FOREIGN KEY FK_42E93517FBD4C859');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE reserva_material');
        $this->addSql('DROP TABLE reserva_sala');
        $this->addSql('DROP TABLE sala');
        $this->addSql('DROP TABLE total_reservas');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
