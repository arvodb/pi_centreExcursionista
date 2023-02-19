INSERT INTO material (NOMBRE, STOCK, ARMARIO)
VALUES
('Cuerda de escalada', 15, 1),
('Mosquetones', 50, 1),
('Cascos de escalada', 10, 2),
('Pies de gato', 20, 3),
('Mochilas de excursión', 30, 4),
('Arnés de escalada', 20, 1),
('Cintas exprés', 40, 1),
('Anillos de cinta', 50, 1),
('Magnesio en polvo', 25, 1),
('Rocódromos portátiles', 5, 2),
('Casco de ciclismo', 12, 2),
('Bicicleta de montaña', 8, 2),
('Piolet de alpinismo', 15, 3),
('Crampones de alpinismo', 12, 3),
('Cuerdas de rappel', 18, 3),
('Sacos de dormir', 22, 4),
('Frontales para escalada', 30, 4),
('Mochilas de hidratación', 40, 4),
('Cantimploras', 60, 4),
('Botiquín de primeros auxilios', 5, 5);;

INSERT INTO reserva_material (CANTIDAD, FECHA_RESERVA, FECHA_DEVOLUCION, ESTADO, ID_USUARIO, ID_MATERIAL)
VALUES
(2, '2023-02-25', '2023-02-27', 'Reservado', 1, 1),
(1, '2023-02-25', '2023-02-27', 'Reservado', 2, 2),
(1, '2023-02-05', '2023-02-09', 'Reservado', 2, 2),
(3, '2023-03-10', '2023-03-15', 'Reservado', 3, 3),
(2, '2023-03-10', '2023-03-15', 'Reservado', 4, 4),
(1, '2023-03-20', '2023-03-22', 'Reservado', 5, 5),
(2, '2023-03-20', '2023-03-22', 'Reservado', 1, 1),
(3, '2023-03-12', '2023-03-17', 'Reservado', 3, 3),
(2, '2023-03-20', '2023-03-25', 'Reservado', 4, 4),
(1, '2023-03-20', '2023-03-25', 'Reservado', 5, 9),
(2, '2023-04-08', '2023-04-13', 'Reservado', 6, 6),
(1, '2023-04-08', '2023-04-13', 'Reservado', 7, 7),
(3, '2023-04-27', '2023-05-02', 'Reservado', 8, 8),
(2, '2023-04-27', '2023-05-02', 'Reservado', 9, 9),
(1, '2023-05-20', '2023-05-24', 'Reservado', 1, 10),
(2, '2023-05-20', '2023-05-24', 'Reservado', 2, 11),
(1, '2023-06-12', '2023-06-16', 'Reservado', 3, 12),
(3, '2023-06-12', '2023-06-16', 'Reservado', 4, 13),
(2, '2023-07-05', '2023-07-10', 'Reservado', 5, 14),
(1, '2023-07-05', '2023-07-10', 'Reservado', 6, 15),
(2, '2023-07-26', '2023-07-31', 'Reservado', 7, 16),
(1, '2023-07-26', '2023-07-31', 'Reservado', 8, 17),
(3, '2023-08-18', '2023-08-23', 'Reservado', 9, 18),
(2, '2023-08-18', '2023-08-23', 'Reservado', 1, 19),
(1, '2023-09-12', '2023-09-16', 'Reservado', 2, 20);

INSERT INTO reserva_sala (FECHA_RESERVA, HORARIO, ID_USUARIO, NUMERO_SALA)
VALUES
('2023-03-01', '10:00-12:00', 1, 1),
('2023-03-03', '12:00-14:00', 2, 2),
('2023-03-05', '14:00-16:00', 3, 3),
('2023-03-07', '16:00-18:00', 4, 4),
('2023-03-09', '18:00-20:00', 5, 5);

INSERT INTO sala (NUMERO_SALA)
VALUES
(1),
(2),
(3),
(4),
(5);

INSERT INTO total_reservas (NOMBRE, TOTAL)
VALUES
('Reservas de material', 5),
('Reservas de sala', 5),
('Total reservas', 10);

INSERT INTO `usuario` (`ID`, `NOMBRE_USUARIO`, `CONTRASEÑA`, `CORREO`, `PRIVILEGIO`) VALUES
(1, 'eeriic20', 'Hola1234', 'ericquintero2002@gmail.com', 'Administrador'),
(2, 'arvo', 'Adios1234', 'arvo@gmail.com', 'Administrador'),
(3, 'andreset', 'Buenas1234', 'andres@gmail.com', 'Administrador'),
(4, 'hector', 'Good1234', 'hector@gmail.com', 'Administrador'),
(5, 'alejandro', 'Tardes1234', 'alejandro@gmail.com', 'Administrador'),
(6, 'juanjet1244', 'Juanjo1234', 'juanjet1244', 'Usuario'),
(7, 'pepet', 'Pepe1234', 'pepet@gmail.com', 'Usuario'),
(8, 'Paco', 'Paco1234', 'paquito@gmail.com', 'Usuario'),
(9, 'Juan', 'Juan1234', 'juanet@gmail.com', 'Usuario');

