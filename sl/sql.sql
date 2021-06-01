DROP DATABASE IF EXISTS `sl`;
CREATE DATABASE IF NOT EXISTS `sl`;
USE `sl`;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(11) NOT NULL,
  `nome`  VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MYISAM;

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(11) NOT NULL,
  `genero` VARCHAR(1) NOT NULL,
  `ano_nascimento` INT NOT NULL,    
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MYISAM;


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `user` VARCHAR(150) NOT NULL,
  `zipcode` VARCHAR(10) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MYISAM;



INSERT INTO `usuario` (`cpf`, `nome`) VALUES
('16798125050', 'Luke Skywalker'),
('07583509025', 'Bruce Wayne'),
('04707649025', 'Diane Prince'), 
('21142450040', 'Bruce Banner'), 
('83257946074', 'Harley Quinn'), 
('59875804045', 'Peter Parker');

INSERT INTO `info` (`cpf`, `genero`, `ano_nascimento`) VALUES 
('16798125050', 'M', 1976),
('07583509025', 'M', 1960),
('04707649025', 'F', 1988),
('21142450040', 'M', 1954),
('83257946074', 'F', 1970),
('59875804045', 'M', 1972);

SELECT
    CONCAT(u.nome, ' - ', i.genero) AS usuario
    , CASE
        WHEN (YEAR(CURRENT_DATE) - i.ano_nascimento) > 50 THEN 'SIM'
        ELSE 'NÃO'
    END maior_50_anos
FROM `usuario` u 
JOIN `info` i ON i.cpf = u.cpf
WHERE i.genero = 'M'
ORDER BY u.nome DESC, i.ano_nascimento ASC
LIMIT 3
