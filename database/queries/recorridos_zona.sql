SELECT p.*
FROM trips p, zones z
WHERE z.id = ID_Zona
AND ST_Intersects(p.geom, z.geom) = 't'
ORDER BY p.id ASC
