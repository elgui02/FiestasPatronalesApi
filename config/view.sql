CREATE VIEW `FiestasActualizadas` AS SELECT 
  *,
  DATE(concat(YEAR(NOW()),'-',MONTH(fecha_inicio),'-',day(fecha_inicio))) as finicio, 
  DATE(concat(IF (MONTH(fecha_inicio)>MONTH(fecha_fin), YEAR(NOW())+1,YEAR(NOW())) ,'-',MONTH(fecha_fin),'-',day(fecha_fin))) as ffin 
FROM `FiestaPatronal`;
