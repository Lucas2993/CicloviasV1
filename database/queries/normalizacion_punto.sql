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

--Version 2
select ST_Y(t2.punto) as lat, ST_X(t2.punto) as long, ST_Distance(ST_GeomFromText(t2.punto), ST_MakePoint(long, lat)) as distancia
from (
	SELECT ST_AsText((ST_DumpPoints(r.geom::geometry)).geom) as punto
	FROM roads r
	WHERE r.id in
		(select t1.road
		   from(
			select r.id as road, ST_Distance(r.geom, ST_MakePoint(long, lat)) as distance
			from roads r
			where ST_DWithin(r.geom, ST_MakePoint(long, lat), 150)) as t1
		   order by t1.distance
		   limit 4)
		) as t2
order by distancia ASC
limit 1;

--Version 3
select punto, ST_Distance(ST_GeomFromText(t2.punto), ST_MakePoint(long, lat)) as distancia
from (
	SELECT ST_AsText((ST_DumpPoints(r.geom::geometry)).geom) as punto
	FROM roads r
	WHERE r.id in
		(select t1.road
		   from(
			select r.id as road, ST_Distance(r.geom, ST_MakePoint(long, lat)) as distance
			from roads r
			where ST_DWithin(r.geom, ST_MakePoint(long, lat), 150)) as t1
		   order by t1.distance
		   limit 4)
		) as t2
order by distancia ASC
limit 1;
