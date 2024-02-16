

/* cadastrar usuario no sdc cedec_user_ex */
USE gestaocedec;
INSERT INTO cedec_user_ex (usuario,
									 senha,
									 email_rec,
									 id_municipio,
									 trsenha,
									 situacao,
									 cpf,
									 cel,
									 ci,
									 cargo,
									 user_id_valida,
									 modulo) 
									 VALUES ("VALE001",
									 			"eiroieroieorioeri",
												"vale@vale.com",
												1,
												1,
												"ATIVADO",
												"00100200300",
												"31982619060",
												"MG12345678",
												"ENGENHEIRO",
												1,
												"pae");