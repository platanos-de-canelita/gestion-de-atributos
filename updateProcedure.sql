
--Procedimiento para tomar el user y password del admin que modificará el atributo
DELIMITER //
CREATE PROCEDURE Info_admin (IN usr varchar(50), IN passW text, OUT idd_admin_pk int, OUT idd_carrera int)
BEGIN
SELECT id_admin_pk into idd_admin_pk from (atributos.administrador
	admin inner join atributos.carrera carrera on admin.id_depto_fk = carrera.id_depto)  where admin.usuario = usr AND admin.pass = passW;
SELECT  id_carrera into idd_carrera from (atributos.administrador
	admin inner join atributos.carrera carrera on admin.id_depto_fk = carrera.id_depto)  where admin.usuario = usr AND admin.pass = passW;
END//
DELIMITER ;

--Procedimiento para actulizar el atributo
--
DELIMITER //
CREATE PROCEDURE Update_Atributo (IN At_name text, IN Descrip text, IN Pond INT, IN Adm_id INT, IN id_carrer INT)
BEGIN
UPDATE atributos.atributo SET Nombre = At_name, Descripcion = Descrip, Ponderacion = Pond WHERE Admin_id = Adm_id AND id_carrera = id_carrer;
END//
DELIMITER ;

CALL Update_Atributo ("PruebaUpdate", "AFK", 100, @idd_admin_pk, @idd_carrera);


/*INSERT INTO `atributo` (`id_atributo_pk`, `Nombre`, `Descripcion`, `Admin_id`, `id_carrera`) VALUES
(2, 'Atributo a', 'Este es el atributo a', 1, 1);*/

