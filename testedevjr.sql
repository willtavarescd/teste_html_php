create database devjr;
use devjr;
create table tb_profissao(
id_profissao int primary key auto_increment,
profissao varchar(50) not null
);

create table tb_usuarios(
id_usuario int primary key auto_increment,
nome varchar(50) not null,
email varchar(80) not null,
fk_id_profissao int not null,
foreign key(fk_id_profissao) references tb_profissao(id_profissao)
);

DELIMITER $$
CREATE PROCEDURE sp_profissao(
pro varchar(50)
)
BEGIN 
	START TRANSACTION;
		if exists( select * from tb_profissao where profissao = pro) then
			select "esta profissão já estava cadastrada" as resultado;
			rollback;
		else
			INSERT INTO tb_profissao values(null, pro);
			commit;
			select "Profissão cadastrada com sucesso" as resultado;
		end if;
END $$
DELIMITER ;

call sp_profissao("developer junior");
call sp_profissao("developer pleno");
call sp_profissao("developer senior");


DELIMITER $$
CREATE PROCEDURE sp_usuario(
nome varchar(50),
mail varchar(80),
pro int
)
BEGIN 
	START TRANSACTION;
		if exists( select * from tb_usuarios where email = mail) then
			select "Já existe um cadastro com esse e-mail" as resultado;
			rollback;
		else
			INSERT INTO tb_usuarios values(null, nome, mail, pro);
			commit;
			select "Usuário cadastrado com sucesso" as resultado;
		end if;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_atualiza(
id int,
nome varchar(50),
mail varchar(80),
pro int
)
BEGIN 
	START TRANSACTION;
		if exists( select * from tb_usuarios where email = mail and id_usuario <> id) then
			select "Cadastro não foi atualizado pois já existe um cadastro com esse e-mail" as resultado;
			rollback;
		else
			update tb_usuarios set nome = nome, email = mail, fk_id_profissao = pro WHERE id_usuario = id;
			commit;
			select "Cadastro atualizado com sucesso" as resultado;
		end if;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE sp_apaga(
id int
)
BEGIN 
	START TRANSACTION;
		if exists( select * from tb_usuarios where id_usuario = id) then
			delete from tb_usuarios where id_usuario = id;
			select "Cadastro apagado" as resultado;
			commit;
		else
			select "Ocorreu um erro ao tentar apagar o cadastro" as resultado;
            rollback;
		end if;
END $$
DELIMITER ;


create view exibeusuarios as select id_usuario as id, nome, email, fk_id_profissao as id_p, profissao from tb_usuarios inner join tb_profissao on fk_id_profissao = id_profissao order by id_usuario;

select * from exibeusuarios;
select * from tb_profissao;
select * from tb_usuarios;

