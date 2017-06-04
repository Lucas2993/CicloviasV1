SELECT r.*,ST_Line_Interpolate_Point(r.geom::geometry,ST_Line_Locate_Point(r.geom::geometry,ST_PointFromText('POINT(-65.026766 -42.783632)',4326))) as point
FROM roads r
WHERE r.geom && st_expand(ST_MakePoint(-65.026766,-42.783632), 10)
ORDER BY ST_Distance(ST_MakePoint(-65.026766,-42.783632),r.geom)
LIMIT 1;
