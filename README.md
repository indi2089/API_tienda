# Proyecto Tienda de Ropa

- Estudiante: Indira Picado Picado.
- descripcion del proyecto:
 Proyecto: Sistema de Gestión para Tienda de Ropa de Mujer

Este proyecto está basado en un modelo entidad-relación (E-R) que tiene como objetivo gestionar  información de una tienda de ropa de mujer. El sistema organiza los datos en torno a tres entidades clave: marca, prenda y ventas, las cuales están interrelacionadas a través de claves foráneas, asegurando la integridad de los datos.
 1. Entidad: Marca
La entidad `marca` representa las diferentes marcas de ropa disponibles en la tienda. Cada marca tiene un identificador único que se relaciona con las prendas que ofrece la tienda. Esta entidad asegura que las prendas estén clasificadas de acuerdo a su marca.

- Atributos: 
  - `id_marca`: Identificador único de la marca.
  - `nombre`: Nombre de la marca (por ejemplo, Nike, Adidas).

 2. Entidad: Prenda
La entidad `prenda` representa los productos de la tienda. Cada prenda está asociada a una marca y tiene un precio específico. A través de la relación con la entidad `marca`, se puede gestionar qué prendas pertenecen a cada marca.

- Atributos: 
  - `id_prenda`: Identificador único de la prenda.
  - `nombre`: Nombre de la prenda (blusa, pantalón, etc.).
  - `id_marca`: Clave foránea que asocia la prenda con su marca.
  - `precio`: Precio de la prenda.

 3. Entidad: Venta
La entidad `venta` registra todas las transacciones realizadas en la tienda. Cada venta incluye información sobre la prenda vendida, la cantidad, el precio de venta y la fecha de la transacción. Las ventas están directamente relacionadas con las prendas, permitiendo un control detallado sobre el inventario y las ganancias.

- Atributos: 
  - `id_venta`: Identificador único de la venta.
  - `id_prenda`: Clave foránea que identifica la prenda vendida.
  - `cantidad`: Cantidad de prendas vendidas.
  - `fecha_venta`: Fecha de la venta.
  - `precio`: Precio al que se vendió la prenda.

 Relaciones entre las Entidades

- Relación Marca-Prenda: Una marca puede tener múltiples prendas asociadas, lo que refleja una relación **uno a muchos**. Esto permite gestionar las prendas por marca, facilitando el análisis de ventas por marca específica.
  
- Relación Prenda-Venta: Una prenda puede aparecer en múltiples ventas, pero cada venta está relacionada con una prenda específica. Esta es una relación **uno a muchos** entre las prendas y las ventas, permitiendo controlar el inventario y las ventas realizadas.

