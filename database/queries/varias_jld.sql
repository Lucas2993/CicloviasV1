--Consulta 1
select distinct on(ST_Intersection(t1.geom, t2.geom))
    t1.id as id_t1, t1.distance_km as distance_t1,
    t2.id as id_t2, t2.distance_km as distance_t2,
    ST_Intersection(t1.geom, t2.geom) as intersection
    from trips t1, trips t2
    where t1.id <> t2.id
    and ST_Intersects(t1.geom, t2.geom)
    and t1.datalog_id = 60 and t2.datalog_id = 60
    and ST_Length(ST_Intersection(t1.geom, t2.geom))>= (0.3 * minimo(t1.distance_km, t2.distance_km))

-- Consulta 2
select distinct on(ST_Intersection(t1.geom, t2.geom))
  t1.id as id_t1, t1.distance_km as distance_t1,
  t2.id as id_t2, t2.distance_km as distance_t2,
  ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2) as intersection
  from trips t1, trips t2
  where t1.id <> t2.id
  and ST_Intersects(t1.geom, t2.geom)
  and t1.datalog_id = 60 and t2.datalog_id = 60
  and ST_Length(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography)>= (0.3 * cv_minimo(t1.distance_km, t2.distance_km))

--Consulta 3
  select distinct on(ST_Intersection(t1.geom, t2.geom))
    t1.id as id_t1, t1.distance_km as distance_t1,
    t2.id as id_t2, t2.distance_km as distance_t2,
    ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2) as intersection,
    cv_frequency_journey(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography, 60) as frequency
    from trips t1, trips t2
    where t1.id <> t2.id
    and ST_Intersects(t1.geom, t2.geom)
    and t1.datalog_id = 60 and t2.datalog_id = 60
    and ST_Length(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography)>= (0.3 * cv_minimo(t1.distance_km, t2.distance_km))

-- Consulta 4
select distinct on(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry, 2))
    ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2) as intersection,
    cv_frequency_journey(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography, 60) as frequency,
    ST_Length(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography) as length
    from trips t1, trips t2
    where t1.id <> t2.id
    and ST_Intersects(t1.geom, t2.geom)
    and t1.datalog_id = COALESCE(null, t1.datalog_id) and t2.datalog_id = COALESCE(null, t2.datalog_id)
    and ST_Length(ST_CollectionExtract(ST_Intersection(t1.geom, t2.geom)::geometry,2)::geography)>= (0.3 * cv_minimo(t1.distance_mts, t2.distance_mts))
