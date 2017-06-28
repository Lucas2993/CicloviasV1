-- Se encarga de traer un punto aleatorio de una calle que intersecciona con la zona especificada (tambien el id de la calle).
SELECT dumped_points.id as road_id, dumped_points.geom as point_geom
FROM (
	-- Obtener todos los puntos pertenecientes a la calle obtenida.
	SELECT intersection_road.id as id, (ST_DumpPoints(intersection_road.geom::geometry)).geom as geom
	FROM (
		-- Traer una calle de mandera aleatoria que tenga una interseccion con la zona especificada.
		SELECT r.id as id, r.geom as geom
		FROM roads r, zones z
		WHERE z.id = <ID_Zona>
		AND ST_Intersects( r.geom::geometry , z.geom::geometry) = 't'
		ORDER BY random()
		LIMIT 1
	) as intersection_road
) as dumped_points, zones z
WHERE z.id = <ID_Zona>
AND ST_Contains(z.geom::geometry, dumped_points.geom::geometry) = 't'
ORDER BY random()
LIMIT 1
