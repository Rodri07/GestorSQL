-- Comando de DDL

####### CREATE TABLE  ########

CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(10) NOT NULL
);

####### ALTER TABLE  ########

ALTER TABLE estudiantes
ADD apellido varchar(20) NOT NULL;


###### DROP TABLE ########

DROP TABLE estudiantes;

--------- TRUNCATE TABLE --------
TRUNCATE TABLE estudiantes;

------- COMENT TABLE ----------------
CREATE TABLE estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL COMMENT 'Identificador único del estudiante',
    nombre VARCHAR(10) NOT NULL COMMENT 'Nombre del estudiante'
);

------ RENAME -------------------
ALTER TABLE estudiantes RENAME TO alumnos;


------------ COMANDO DML ------------------

SELECT * from estudiantes;

INSERT INTO estudiantes (nombre) VALUES
('carla'),
('juan'),
('maria'),
('pedro');


UPDATE estudiantes SET nombre = 'María' WHERE id = 1;

DELETE FROM alumnos WHERE id = 6;

INSERT INTO nuevos_estudiantes (nombre)
SELECT nombre FROM alumnos WHERE id >= 4;


-- COMANDOS DCL ---

use mysql; -- base de datos

select *from mysql.user; -- en esta tabla se guardan los usuarios

-- creacion de un usuario
CREATE USER 'rodri'@'localhost' IDENTIFIED BY 'admin';

-- privilegios globales es decir todos los permisos que existen
GRANT ALL privileges ON *.* TO 'rodri'@'localhost';

-- mostrar privilegios --
SHOW GRANTS FOR 'rodri'@'localhost';

-- Asignamos todos los privilegios a un usuario, WITH GRANT OPTION nos permite tener el poder de crear y agregar permisos a otro usuario
GRANT ALL PRIVILEGES ON *.* TO 'rodri'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION;

-- quitar privilegios --
REVOKE ALL PRIVILEGES ON *.* FROM 'rodri'@'localhost';
select *from mysql.user;

-- quitar comandos dml --
REVOKE UPDATE ON *.* FROM 'rodri'@'localhost';

-- Eliminar usuario creado
 DROP USER 'rodri'@'localhost';


-- -----------------------------------------------------------------------
 -- Asignar permisos a una base de datos especifica y a todas sus tablas, tambien podra crear un usuario y asiganar acceso a base de datos sistemacursos gracia al grant option
 GRANT ALL PRIVILEGES ON sistemacursos.* TO 'rodri'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION;
 GRANT ALL PRIVILEGES ON universidad.* TO 'rodri'@'localhost' IDENTIFIED BY 'admin' WITH GRANT OPTION;


 -- revocar privilegios de sistemacursos --
 REVOKE ALL privileges ON sistemacursos.* FROM 'rodri'@'localhost';
 -- revocar privilegios de select en la base de datos universidad
 revoke select on universidad.* from 'rodri'@'localhost';

 -- privilegios a nivel tabla --
GRANT ALL privileges ON sistemacursos.carreras to 'pana'@'localhost';
 use mysql;
 show tables;
 select *from tables_priv;
 -- revocar privilegios a nivel tablas --
 REVOKE update ON sistemacursos.carreras from 'rodri'@'localhost';

 -- privilegios a nivel columna --
 GRANT SELECT(cod_peli,nombre_peli) on cine.peliculas to 'rodri'@'localhost' identified by 'admin' with grant option;
 select * from columns_priv;
 -- remueve permisos agregados anteriomente de las columnas
REVOKE SELECT(cod_peli,nombre_peli) on cine.peliculas FROM 'rodri'@'localhost';

-- otorga permisos a una base de datos y a una tabla especifica
GRANT ALL privileges ON cine.peliculas to 'rodri'@'localhost';

-- tambien muestra los privilegios asignados al usuario
 SHOW GRANTS FOR CURRENT_USER();

  SET PASSWORD FOR 'rodri'@'localhost' = PASSWORD('admin');





php artisan migrate

php artisan db:seed --class=DatabaseSeeder




-- Estructura --

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`RECETA` (
  `idReceta` INT(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NOT NULL,
  `Cantidad` INT(11) NOT NULL,
  PRIMARY KEY (`idReceta`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`ESTABLECIMIENTO` (
  `idEstablecimiento` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre_Establecimiento` VARCHAR(45) NOT NULL,
  `Telefono` INT(11) NOT NULL,
  `Num_Local` INT(11) NOT NULL,
  `Categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idEstablecimiento`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`RESTAURANTE` (
  `idRestaurante` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Direccion` VARCHAR(45) NOT NULL,
  `codigo` INT(11) NOT NULL,
  `Telefono` INT(11) NOT NULL,
  `RECETA_idReceta` INT(11) NOT NULL,
  `ESTABLECIMIENTO_idEstablecimiento` INT(11) NOT NULL,
  PRIMARY KEY (`idRestaurante`),
  INDEX `idreceta_idx` (`RECETA_idReceta` ASC),
  INDEX `idestablecimiento_idx` (`ESTABLECIMIENTO_idEstablecimiento` ASC),
  FOREIGN KEY (`RECETA_idReceta`) REFERENCES `mydb`.`RECETA` (`idReceta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`ESTABLECIMIENTO_idEstablecimiento`) REFERENCES `mydb`.`ESTABLECIMIENTO` (`idEstablecimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`CARGO` (
  `idCargo` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCargo`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`CARTA` (
  `idCarta` INT(11) NOT NULL,
  `id_Restaurante` VARCHAR(45) NOT NULL,
  `id_Platos` VARCHAR(45) NOT NULL,
  `Descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCarta`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`PERSONAL` (
  `idPersonal` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Apellido_Paterno` VARCHAR(45) NOT NULL,
  `Apellido_Materno` VARCHAR(45) NOT NULL,
  `Sueldo` INT(11) NOT NULL,
  `Turno` VARCHAR(45) NOT NULL,
  `Cargo` VARCHAR(45) NOT NULL,
  `CARGO_idCargo` INT(11) NOT NULL,
  `CARTA_idCarta` INT(11) NOT NULL,
  PRIMARY KEY (`idPersonal`),
  INDEX `idcargo_idx` (`CARGO_idCargo` ASC),
  INDEX `idcarta_idx` (`CARTA_idCarta` ASC),
  CONSTRAINT `idcargo`
    FOREIGN KEY (`CARGO_idCargo`)
    REFERENCES `mydb`.`CARGO` (`idCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idcarta`
    FOREIGN KEY (`CARTA_idCarta`)
    REFERENCES `mydb`.`CARTA` (`idCarta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`ADMINISTRADOR` (
  `idAdministrador` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Apellido_Paterno` VARCHAR(45) NOT NULL,
  `Apellido_Materno` VARCHAR(45) NOT NULL,
  `Direccion` VARCHAR(45) NOT NULL,
  `Telefono` INT(11) NOT NULL,
  `RESTAURANTE_idRESTAURANTE` INT(11) NOT NULL,
  `PERSONAL_idPersonal` INT(11) NOT NULL,
  PRIMARY KEY (`idAdministrador`),
  INDEX `idrestaurante_idx` (`RESTAURANTE_idRESTAURANTE` ASC) ,
  INDEX `idpersonal_idx` (`PERSONAL_idPersonal` ASC) ,
  CONSTRAINT `idrestaurante`
    FOREIGN KEY (`RESTAURANTE_idRESTAURANTE`)
    REFERENCES `mydb`.`RESTAURANTE` (`idRestaurante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `idpersonal`
    FOREIGN KEY (`PERSONAL_idPersonal`)
    REFERENCES `mydb`.`PERSONAL` (`idPersonal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `mydb`.`TIPO_MENU` (
  `idTipo_Menu` INT(11) NOT NULL,
  `Descripcion` VARCHAR(45) NOT NULL,
  `Precio` INT(11) NOT NULL,
  PRIMARY KEY (`idTipo_Menu`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`PLATOS` (
  `idPlatos` INT(11) NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Descripcion` VARCHAR(45) NOT NULL,
  `Precio` INT(11) NOT NULL,
  `CARTA_idCarta` INT(11) NOT NULL,
  `TIPOMENU_idTipoMenu` INT(11) NOT NULL,
  PRIMARY KEY (`idPlatos`),
  INDEX `idcarta_idx` (`CARTA_idCarta` ASC),
  INDEX `idtipomenu_idx` (`TIPOMENU_idTipoMenu` ASC),
  FOREIGN KEY (`CARTA_idCarta`) REFERENCES `mydb`.`CARTA` (`idCarta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (`TIPOMENU_idTipoMenu`) REFERENCES `mydb`.`TIPO_MENU` (`idTipo_Menu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`VENTAS_PLATOS` (
  `idVenta_Platos` INT(11) NOT NULL,
  `Fecha` DATE NOT NULL,
  `Hora` INT(11) NOT NULL,
  `Monto` INT NOT NULL,
  `Tipo_Pago` INT(11) NOT NULL,
  `PLATOS_idPlatos` INT(11) NOT NULL,
  PRIMARY KEY (`idVenta_Platos`),
  INDEX `idplatos_idx` (`PLATOS_idPlatos` ASC),
  CONSTRAINT `idplatos`
    FOREIGN KEY (`PLATOS_idPlatos`)
    REFERENCES `mydb`.`PLATOS` (`idPlatos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`PEDIDOS_VENTAS` (
  `idPedidos` INT(11) NOT NULL,
  `Fecha` DATE NOT NULL,
  `Monto_Final` INT NOT NULL,
  `VENTAS_PLATOS_idPlatos` INT(11) NOT NULL,
  PRIMARY KEY (`idPedidos`),
  INDEX `idventaplatos_idx` (`VENTAS_PLATOS_idPlatos` ASC),
  CONSTRAINT `idventaplatos`
    FOREIGN KEY (`VENTAS_PLATOS_idPlatos`)
    REFERENCES `mydb`.`VENTAS_PLATOS` (`idVenta_Platos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`CLIENTES` (
  `idClientes` VARCHAR(45) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Apellido_Paterno` VARCHAR(45) NOT NULL,
  `Apellido_Materno` VARCHAR(45) NOT NULL,
  `Direccion` VARCHAR(45) NOT NULL,
  `Telefono` INT NOT NULL,
  `Tipo_Pago` VARCHAR(45) NOT NULL,
  `PEDIDOS_VENTAS_idPedidos` INT(11) NOT NULL,
  PRIMARY KEY (`idClientes`),
  INDEX `idpedidosventas_idx` (`PEDIDOS_VENTAS_idPedidos` ASC),
  CONSTRAINT `idpedidosventas`
    FOREIGN KEY (`PEDIDOS_VENTAS_idPedidos`)
    REFERENCES `mydb`.`PEDIDOS_VENTAS` (`idPedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`CAJA` (
  `idCaja` INT(11) NOT NULL,
  `Nombre_Plato` VARCHAR(45) NOT NULL,
  `Precio` INT(11) NOT NULL,
  `Tipo_Pago` INT(11) NOT NULL,
  PRIMARY KEY (`idCaja`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`CLIENTES_has_CAJA` (
  `CLIENTES_idCliente` VARCHAR(45) NOT NULL,
  `CLIENTES_PEDIDOS_VENTA_idPedidos` INT(11) NOT NULL,
  `CAJA_idCaja` INT(11) NOT NULL,
  PRIMARY KEY (`CLIENTES_idCliente`, `CLIENTES_PEDIDOS_VENTA_idPedidos`),
  INDEX `idpedidosventas_idx` (`CLIENTES_PEDIDOS_VENTA_idPedidos` ASC),
  INDEX `idcaja_idx` (`CAJA_idCaja` ASC),
  FOREIGN KEY (`CLIENTES_PEDIDOS_VENTA_idPedidos`)
    REFERENCES `mydb`.`PEDIDOS_VENTAS` (`idPedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  FOREIGN KEY (`CAJA_idCaja`)
    REFERENCES `mydb`.`CAJA` (`idCaja`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`INGREDIENTES` (
  `codIngredientes` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Precio_Compra` DECIMAL NOT NULL,
  `Stok_Almacen` INT NOT NULL,
  PRIMARY KEY (`codIngredientes`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `sistemarestaurante`.`PROVEEDORES` (
  `idProveedores` INT NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `Direccion` VARCHAR(45) NOT NULL,
  `Telefono` INT(11) NOT NULL,
  `E_mail` VARCHAR(45) NOT NULL,
  `INGREDIENTES_codIngredientes` INT(11) NOT NULL,
  PRIMARY KEY (`idProveedores`),
  INDEX `idingredientes_idx` (`INGREDIENTES_codIngredientes` ASC),
  CONSTRAINT `idingredientes`
    FOREIGN KEY (`INGREDIENTES_codIngredientes`)
    REFERENCES `mydb`.`INGREDIENTES` (`codIngredientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
