CREATE PROCEDURE Info_admin @usuario nvarchar(50), @pass text
AS
SELECT id_admin_pk, id_carrera from (atributos.administrador 
	admin inner join atributos.carrera carrera on admin.id_depto_fk = carrera.id_depto)  where admin.usuario = @usuario AND admin.pass = @pass
return




CREATE PROCEDURE DeleteAtribute @Atribute_name text, @Admin_id INT, @id_carrera INT
AS
UPDATE atributo SET Estado=false WHERE Nombre = @Atribute_name AND Admin_id = @Admin_id AND id_carrera = @id_carrerae AND Estado=true
GO;

EXEC DeleteAtribute Atribute_name = "London", Admin_id = "London", id_carrera = "WA1 1DP";
EXEC DeleteAtribute Atribute_name = "London", (EXEC Info_admin usuario="canelita", pas="canelita")




DROP PROCEDURE IF EXISTS dbo.uspMyProc;  
GO 




DELIMITER //
CREATE PROCEDURE Info_admin (IN usr varchar(50), IN passW text, OUT idd_admin_pk int, OUT idd_carrera int)
BEGIN
SELECT id_admin_pk into idd_admin_pk, id_carrera into idd_carrera from (atributos.administrador 
	admin inner join atributos.carrera carrera on admin.id_depto_fk = carrera.id_depto)  where admin.usuario = usr AND admin.pass = passW;
END//
DELIMITER ;
CALL Info_admin ("canelita","canelita", @idd_admin_pk,@idd_carrera)
SELECT @idd_carrera
SELECT @idd_admin_pk


DELIMITER //
CREATE PROCEDURE DeleteAtribute (IN Atribute_name text, IN Adm_id INT, in id_carrer INT)
BEGIN
UPDATE atributos.atributo SET Estado=false WHERE Nombre = Atribute_name AND Admin_id = Adm_id AND id_carrera = id_carrer AND Estado=true;
END//
DELIMITER ;

CALL Info_admin ("atrib1",CALL Info_admin("canelita","canelita"))







DELIMITER //
CREATE PROCEDURE Info_admin (IN usr varchar(50), IN passW text, OUT idd_admin_pk int, OUT idd_carrera int)
BEGIN
SELECT id_admin_pk into idd_admin_pk from (atributos.administrador 
	admin inner join atributos.carrera carrera on admin.id_depto_fk = carrera.id_depto)  where admin.usuario = usr AND admin.pass = passW;
SELECT  id_carrera into idd_carrera from (atributos.administrador 
	admin inner join atributos.carrera carrera on admin.id_depto_fk = carrera.id_depto)  where admin.usuario = usr AND admin.pass = passW;
END//
DELIMITER ;
CALL Info_admin ("canelita","canelita", @idd_admin_pk,@idd_carrera);
SELECT @idd_carrera;

DELIMITER //
CREATE PROCEDURE DeleteAtribute (IN Atribute_name text, IN Adm_id INT, in id_carrer INT)
BEGIN
UPDATE atributos.atributo SET Estado=false WHERE Nombre = Atribute_name AND Admin_id = Adm_id AND id_carrera = id_carrer AND Estado=true;
END//
DELIMITER ;

CALL DeleteAtribute ("atrib1", @idd_admin_pk, @idd_carrera)


CALL Info_admin ("canelita","canelita", @idd_admin_pk,@idd_carrera);
SELECT @idd_carrera;
CALL DeleteAtribute ("Atributo b", @idd_admin_pk, @idd_carrera)