--QUERY FINNAL CON INNER
select 
a.nombre, b.fecha, d.nombre, e.horario 
from canal a
INNER JOIN programacion c
ON c.id_canal = a.id_canal
INNER JOIN fecha b
ON b.id_fecha = c.id_fecha
INNER JOIN programacion_contenido f
ON c.id_programacion = f.id_programacion
INNER JOIN contenido e
ON f.id_contenido = e.id_contenido
INNER JOIN programas_contenido g
ON g.id_contenido = e.id_contenido
INNER JOIN programas d
ON d.id_programa = g.id_programa
WHERE b.fecha = '2013-10-08' AND a.nombre='canal 5'


--QUERY FINAL CON ALIAS
select a.nombre, b.fecha, d.nombre, e.horario 
from canal a, fecha b, programacion c, programacion_contenido f, contenido e, 
programas_contenido g, programas d 
where b.fecha = '2013-10-11' AND a.nombre = 'CANAL de las estrellas' 
AND c.id_programacion = f.id_programacion AND f.id_contenido = e.id_contenido 
AND e.id_contenido = g.id_contenido AND d.id_programa = g.id_programa AND c.id_canal = a.id_canal and b.id_fecha = c.id_fecha
