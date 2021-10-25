SELECT * FROM aula.pessoa;CREATE TABLE `pessoa` (
  `idpessoa` int NOT NULL AUTO_INCREMENT,
  `nome_fatasia` varchar(120) DEFAULT NULL,
  `sobrenome_razao` varchar(120) DEFAULT NULL,
  `cpf_cnpj` varchar(35) DEFAULT NULL,
  `rg_ie` varchar(60) DEFAULT NULL,
  `nascimento_fundacao` date DEFAULT NULL,
  PRIMARY KEY (`idpessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;