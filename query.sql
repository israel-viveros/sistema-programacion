select 




QUERY FINAL


select a.nombre, b.fecha, d.nombre, e.horario 
from canal a, fecha b, programacion c, programacion_contenido f, contenido e, 
programas_contenido g, programas d 
where b.fecha = '2013-10-11' AND a.nombre = 'CANAL de las estrellas' 
AND c.id_programacion = f.id_programacion AND f.id_contenido = e.id_contenido 
AND e.id_contenido = g.id_contenido AND d.id_programa = g.id_programa AND c.id_canal = a.id_canal and b.id_fecha = c.id_fecha
