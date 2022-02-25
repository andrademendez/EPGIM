CREATE VIEW vEspacioConfirmado AS
SELECT campanias.id as id_campania,
    title,
    start,
end,
espacios.id as id_espacio,
espacios.nombre
FROM campania_espacio
    INNER JOIN campanias ON campania_espacio.id_campania = campanias.id
    INNER JOIN espacios ON campania_espacio.id_espacio = espacios.id
where campanias.status IN  ('Confirmado', 'Cerrado');


/**view_espacio */
CREATE VIEW vCampaniaEspacio AS
SELECT campanias.id as id_campania,
    title,
    start,
end,
campanias.status,
display,
hold,
users.name AS users,
clientes.nombre as cliente,
medios.nombre AS medios,
espacios.id as id_espacio,
espacios.nombre
FROM campania_espacio
    INNER JOIN campanias ON campania_espacio.id_campania = campanias.id
    INNER JOIN espacios ON campania_espacio.id_espacio = espacios.id
     INNER JOIN users ON users.id = campanias.id_user
    INNER JOIN clientes ON clientes.id = campanias.id_cliente
    INNER JOIN medios ON medios.id = campanias.id_medio
ORDER BY `hold` ASC;

/** vCampanias **/
CREATE VIEW vCampanias AS
SELECT campanias.id AS id,
    title,
    start,
end,
campanias.status AS estado,
hold,
display as backgroundColor,
users.name AS users,
clientes.nombre as cliente,
medios.nombre AS medios
FROM campanias
    INNER JOIN users ON users.id = campanias.id_user
    INNER JOIN clientes ON clientes.id = campanias.id_cliente
    INNER JOIN medios ON medios.id = campanias.id_medio
ORDER BY `id` ASC;
/** **/
CREATE VIEW vEspacio AS
SELECT campanias.id as campania,
    espacios.id as espacio,
    espacios.nombre,
    espacios.referencia
FROM campania_espacio
    INNER JOIN campanias ON campania_espacio.id_campania = campanias.id
    INNER JOIN espacios ON campania_espacio.id_espacio = espacios.id
ORDER BY `hold` ASC;
/** pendiente */
CREATE VIEW vFechaBloqueov2 AS
SELECT bl.fecha as fecha,
    cn.id as id_campania,
    cn.title as nombre,
    cn.status as estatus,
    cn.start as inicio,
    cn.end as final,
    es.nombre as pantalla,
    es.id as id_pantalla
FROM bloqueo_campania as bc
    INNER JOIN bloqueos AS bl ON bc.id_bloqueo = bl.id
    INNER JOIN campanias AS cn ON bc.id_campania = cn.id
    INNER JOIN campania_espacio as ce ON cn.id = ce.id_campania
    INNER JOIN espacios AS es ON ce.id_espacio = es.id
ORDER BY 'fecha' ASC;
