-- NOTA: Si laravel devuelve al revez las coordenadas en algún LineString
ALTER TABLE trips
  ALTER COLUMN geom TYPE geography(LineString,4326)
  USING ST_FlipCoordinates(
    geom::geometry)::geography(LineString,4326);