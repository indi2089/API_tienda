Tabla de Marcas
CREATE TABLE tienda_ropa_mujer_marca (
    id_marca INT AUTO_INCREMENT PRIMARY KEY,  -- id autoincrementable para las marcas
    nombre VARCHAR(50) NOT NULL UNIQUE        -- Nombre único de la marca
);
 
-- Tabla de Prendas
CREATE TABLE tienda_ropa_mujer_prenda (
    id_prenda INT AUTO_INCREMENT PRIMARY KEY,       -- id autoincrementable para las prendas
    nombre VARCHAR(50) NOT NULL,                    -- Nombre de la prenda
    id_marca INT,                                   -- Clave foránea que refiere a la tabla de marcas
    precio DECIMAL(10, 2) NOT NULL CHECK (precio >= 0), -- Precio de la prenda, con 2 decimales
    FOREIGN KEY (id_marca) REFERENCES tienda_ropa_mujer_marca(id_marca) -- Relación con la tabla de marcas
);
 
-- Tabla de Ventas
CREATE TABLE tienda_ropa_mujer_ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,        -- id autoincrementable para las ventas
    id_prenda INT,                                  -- Clave foránea que refiere a la tabla de prendas
    cantidad INT NOT NULL CHECK (cantidad > 0),     -- Cantidad vendida, debe ser mayor a 0
    fecha_venta DATE NOT NULL,                      -- Fecha de la venta
    precio DECIMAL(10, 2) NOT NULL CHECK (precio >= 0), -- Precio al que se vendió la prenda
    FOREIGN KEY (id_prenda) REFERENCES tienda_ropa_mujer_prenda(id_prenda) -- Relación con la tabla de prendas
);
--insertar datos
INSERT INTO tienda_ropa_mujer_marca (nombre)
VALUES ('Marca A'), ('Marca B'), ('Marca C');
INSERT INTO tienda_ropa_mujer_prenda (nombre, id_marca, precio)
VALUES ('Blusa', 1, 15000.00), ('Pantalón', 2, 25000.00), ('Falda', 3, 20000.00);
--select
SELECT * FROM tienda_ropa_mujer_marca;
SELECT p.id_prenda, p.nombre AS prenda, m.nombre AS marca, p.precio
FROM tienda_ropa_mujer_prenda p
JOIN tienda_ropa_mujer_marca m ON p.id_marca = m.id_marca;
--up date 
UPDATE tienda_ropa_mujer_prenda
SET precio = 18000.00
WHERE nombre = 'Blusa';
---delete
DELETE FROM tienda_ropa_mujer_ventas
WHERE id_venta = 1;
---vistas
SELECT
    fecha_venta,
    SUM(cantidad) AS total_prendas_vendidas
FROM
    tienda_ropa_mujer_ventas
WHERE
    fecha_venta = '2024-10-01'  -- Cambia la fecha según lo que necesites
GROUP BY
    fecha_venta;

    ---
    CREATE VIEW marcas_con_ventas AS
SELECT DISTINCT
    m.nombre AS marca
FROM
    tienda_ropa_mujer_marca m
JOIN
    tienda_ropa_mujer_prenda p ON m.id_marca = p.id_marca
JOIN
    tienda_ropa_mujer_ventas v ON p.id_prenda = v.id_prenda;
    ---
    CREATE VIEW prendas_stock_restante AS
SELECT
    p.nombre AS prenda,
    (s.cantidad_inicial - COALESCE(SUM(v.cantidad), 0)) AS cantidad_restante
FROM
    tienda_ropa_mujer_prenda p
JOIN
    tienda_ropa_mujer_stock s ON p.id_prenda = s.id_prenda
LEFT JOIN
    tienda_ropa_mujer_ventas v ON p.id_prenda = v.id_prenda
GROUP BY
    p.id_prenda, p.nombre, s.cantidad_inicial;
    ---
    CREATE VIEW top_5_marcas_mas_vendidas AS
SELECT
    m.nombre AS marca,
    SUM(v.cantidad) AS total_ventas
FROM
    tienda_ropa_mujer_marca m
JOIN
    tienda_ropa_mujer_prenda p ON m.id_marca = p.id_marca
JOIN
    tienda_ropa_mujer_ventas v ON p.id_prenda = v.id_prenda
GROUP BY
    m.id_marca, m.nombre
ORDER BY
    total_ventas DESC
LIMIT 5;