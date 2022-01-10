CREATE VIEW vEspacioConfirmado AS
SELECT
	campanias.id as id_campania, title, start, end, espacios.id as id_espacio, espacios.nombre
FROM campania_espacio
INNER JOIN campanias ON campania_espacio.id_campania = campanias.id
INNER JOIN espacios ON campania_espacio.id_espacio = espacios.id
where campanias.status = 'Confirmado';

/**view_espacio */
CREATE VIEW vCampaniaEspacio AS
SELECT
	campanias.id as id_campania, title, start, end, campanias.status,display, hold, espacios.id as id_espacio, espacios.nombre
FROM campania_espacio
INNER JOIN campanias ON campania_espacio.id_campania = campanias.id
INNER JOIN espacios ON campania_espacio.id_espacio = espacios.id
ORDER BY `hold`  ASC;

CREATE VIEW vCampanias AS
SELECT
    campanias.id AS id, title, start,end, campanias.status AS estado, hold, display as backgroundColor,  users.name AS users, clientes.nombre as cliente, medios.nombre AS medios
FROM
    campanias
INNER JOIN users ON users.id = campanias.id_user
INNER JOIN clientes ON clientes.id = campanias.id_cliente
INNER JOIN medios ON medios.id = campanias.id_medio
ORDER BY `id`  ASC;

CREATE VIEW vEspacio AS
SELECT
	 campanias.id as campania, espacios.id as espacio, espacios.nombre
FROM campania_espacio
INNER JOIN campanias ON campania_espacio.id_campania = campanias.id
INNER JOIN espacios ON campania_espacio.id_espacio = espacios.id
ORDER BY `hold`  ASC;

/** pendiente */
CREATE VIEW vFechaBloqueo AS
SELECT bl.fecha as fecha, cn.id as id_campania, cn.title as nombre, 
	cn.status as estatus, cn.start as inicio, cn.end as final,( SELECT es.id FROM campania_espacio AS ce
INNER JOIN campanias as ca ON ce.id_campania = ca.id
INNER JOIN espacios AS es ON ce.id_espacio = es.id) as espacio
	FROM bloqueo_campania as bc
INNER JOIN bloqueos AS bl ON bc.id_bloqueo = bl.id 
INNER JOIN campanias AS cn ON bc.id_campania = cn.id
ORDER BY 'fecha' ASC;




