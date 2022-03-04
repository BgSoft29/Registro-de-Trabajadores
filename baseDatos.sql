CREATE TABLE trabajadores(
    trabajador_id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    trabajador_nombre VARCHAR(15) NOT NULL,
    trabajador_apellido VARCHAR(25) NOT NULL,
    trabajador_dni CHAR(8) NOT NULL
)

INSERT INTO trabajadores(trabajador_nombre,trabajador_apellido,trabajador_dni) VALUES
    ('Bruno','Buttgenbach Gustavson','71072221')

SELECT * FROM trabajadores

CREATE TABLE ingresos(
    ingresos_trabajador_id INT NOT NULL,
    ingresos_fecha CHAR(10) NOT NULL,
    ingresos_hora CHAR(8) NOT NULL
)
CREATE TABLE salidas(
    salidas_trabajador_id INT NOT NULL,
    salidas_fecha CHAR(10) NOT NULL,
    salidas_hora CHAR(8) NOT NULL
)
SELECT trabajadores.trabajador_id FROM trabajadores WHERE trabajadores.trabajador_dni = '71072221'

INSERT INTO ingresos(ingresos_trabajador_id,ingresos_fecha,ingresos_hora) VALUES
    ('{$}')

SELECT ingresos.ingresos_trabajador_id, ingresos.ingresos_fecha, ingresos.ingresos_hora FROM ingresos

SELECT ingresos.ingresos_trabajador_id, ingresos.ingresos_fecha, ingresos.ingresos_fecha, ingresos.ingresos_hora FROM ingresos WHERE ingresos.ingresos_trabajador_id = 1

SELECT CONCAT(a.trabajador_nombre," ",a.trabajador_apellido," - ",a.trabajador_dni) FROM trabajadores a WHERE a.trabajador_id = 1