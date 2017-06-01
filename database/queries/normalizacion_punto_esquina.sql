--Se obtiene el punto normalizado a una esquina mas cercano.
select dumped.dump, ST_Distance(ST_GeomFromText(dumped.dump), ST_MakePoint(Lon,Lat)) as distancia
from (
	SELECT ST_AsText((ST_DumpPoints(r.geom::geometry)).geom) as dump
	FROM roads r
	WHERE r.id in
		(SELECT distance_a.road
		FROM(
			SELECT r.id as road, ST_Distance(r.geom, ST_MakePoint(Lon,Lat)) AS distance
			from roads r) as distance_a
		order by distance_a.distance
		limit 4)
		) as dumped
order by distancia ASC
limit 1;
