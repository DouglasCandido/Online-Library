drop schema bibliotecaBDD;
create schema bibliotecaBDD;

use bibliotecaBDD;

create table Uf(
    sigla varchar(2) not null,
    nome varchar(25) not null,
    codUf int not null auto_increment,
    primary key (codUf) 
);

insert into uf (sigla, nome) values("AC","Acre");
insert into uf (sigla, nome) values("AL","Alagoas");
insert into uf (sigla, nome) values("AP","Amapá");
insert into uf (sigla, nome) values("AM","Amazonas");
insert into uf (sigla, nome) values("BA","Bahia");
insert into uf (sigla, nome) values("CE","Ceará");
insert into uf (sigla, nome) values("DF","Distrito Federal");
insert into uf (sigla, nome) values("ES","Espírito Santo");
insert into uf (sigla, nome) values("GO","Goiás");
insert into uf (sigla, nome) values("MA","Maranhão");
insert into uf (sigla, nome) values("MT","Mato Grosso");
insert into uf (sigla, nome) values("MS","Mato Grosso do Sul");
insert into uf (sigla, nome) values("MG","Minas Gerais");
insert into uf (sigla, nome) values("PA","Pará");
insert into uf (sigla, nome) values("PB","Paraíba");
insert into uf (sigla, nome) values("PR","Paraná");
insert into uf (sigla, nome) values("PE","Pernambuco");
insert into uf (sigla, nome) values("PI","Piauí");
insert into uf (sigla, nome) values("RJ","Rio de Janeiro");
insert into uf (sigla, nome) values("RN","Rio Grande do Norte");
insert into uf (sigla, nome) values("RS","Rio Grande do Sul");
insert into uf (sigla, nome) values("RO","Rondônia");
insert into uf (sigla, nome) values("RR","Roraima");
insert into uf (sigla, nome) values("SC","Santa Catarina");
insert into uf (sigla, nome) values("SP","São Paulo");
insert into uf (sigla, nome) values("SE","Sergipe");
insert into uf (sigla, nome) values("TO","Tocantins");

/*create table Cidade(
    nome varchar(40) not null,
    codCidade int not null auto_increment,
    uf int not null,
    primary key (codCidade),
    foreign key (uf) references Uf (codUf)
);*/

create table Genero(
    genero varchar(25) not null,
    codGenero int not null auto_increment,
    primary key (codGenero) 
);

insert into Genero (genero) values ("Terror");
insert into Genero (genero) values ("Ação");
insert into Genero (genero) values ("Romance");
insert into Genero (genero) values ("Suspense");
insert into Genero (genero) values ("Erótico");
insert into Genero (genero) values ("Eletrotécnica");
insert into Genero (genero) values ("Informática");
insert into Genero (genero) values ("Educação Física");
insert into Genero (genero) values ("Ficção Científica");
insert into Genero (genero) values ("Romance Policial");
insert into Genero (genero) values ("Química");
insert into Genero (genero) values ("Física");
insert into Genero (genero) values ("Matemática");
insert into Genero (genero) values ("Biologia");

create table Usuario (
    codUsuario int not null auto_increment,
    cpf varchar(14) not null unique,
    email varchar(90) not null,
    nome varchar(90) not null,
    cidade varchar(50) not null,
    rua varchar(90) not null,
    numero int not null,
    bairro varchar(90) not null,
    senha varchar(40),
    primary key (codUsuario),
    uf int not null,
    foreign key (uf) references Uf (codUf)
)  auto_increment=1000;

create table Leitor(
    codLeitor int not null,
    penalizado int(1) not null,
    qtdEmprestimos int default 0 not null,
    primary key (codLeitor),
    foreign key (codLeitor) references Usuario (codUsuario)
);

create table Funcionario (
    codFunc int not null,
    cargo varchar(30) not null,
    turno varchar(10) not null,
    primary key (codFunc),
    foreign key (codFunc) references Usuario (codUsuario)
);

create table Autor(
    codAutor int not null auto_increment,
    cpf varchar(14) not null unique,
    nome varchar(50) not null,
    telefone bigint not null,
    email varchar(90) not null,
    rua varchar(90) not null,
    numero int not null,
    bairro varchar(90) not null,
    cidade varchar(90) not null,
    primary key (codAutor),
    uf int not null,
    foreign key (uf) references Uf (codUf)
) auto_increment = 2000;

create table Editora (
    codEditora int not null auto_increment,
    nome varchar(50) not null,
    cnpj varchar(19) not null unique,
    telefone bigint not null,
    email varchar(90) not null,
    rua varchar(90) not null,
    numero int not null,
    bairro varchar(90) not null,
    cidade varchar(90) not null,
    primary key (codEditora),
    uf int not null,
    foreign key (uf) references Uf (codUf)
)  auto_increment = 3000;

create table Livro (
    codLivro int not null auto_increment,
    isbn varchar(14) not null unique,
    titulo varchar(90) not null,
    edicao int not null,
    ano int not null,
    qtdExemplar int not null,
    genero int not null,
    descricao varchar(255),
    primary key (codLivro),
    foreign key (genero) references Genero (codGenero)
) auto_increment = 1010;

create table CadLivro(
    codAutor int not null,
    codLivro int not null,
    codEditora int not null,
    foreign key (codautor) references Autor(codAutor),
    foreign key (codLivro) references Livro(codLivro),
    foreign key (codEditora) references Editora (codEditora),
    primary key(codAutor,codLivro, codEditora)
);

create table Exemplar (
    codExemplar int not null auto_increment,
    codLivro int not null,
    emprestado int(1) not null,
    primary key(codExemplar, codLivro),
    foreign key (codLivro) references Livro(codLivro)
);

create table Emprestimo (
    codEmprestimo int auto_increment,
    codExemplar int not null,
    codLeitor int not null,
    dtEmprestimo date not null,
    dtPrevista date not null,
    pendente int(1) default 1 not null,
    aprovado int(1) default 0 not null,
    ocorrendo int(1) default 0 not null,
    primary key (codEmprestimo),
    foreign key (codExemplar) references Exemplar (codExemplar),
    foreign key (codLeitor) references Leitor(codLeitor)
) auto_increment = 0;

create table Devolucao (
    codDevolucao int auto_increment,
    codEmprestimo int,
    dtDevolucao date,
    primary key (codDevolucao),
    foreign key (codEmprestimo) references Emprestimo(codEmprestimo)
) auto_increment = 0;

create table Penalizacao (
    codPenalizacao int not null auto_increment,
    codLeitor int not null,
    dtInicio date not null,
    dtFim date not null,
    primary key (codPenalizacao),
    foreign key (codLeitor) references Leitor (codLeitor)
) auto_increment = 0;

/* Views */

create view getUfs as select * from uf;
create view getGen as select * from genero;
create view getAutor as select nome, codAutor from autor;
create view getEditora as select nome, codeditora from editora;
create view getEmprestimos as select qtdEmprestimos as emprestimos, codLeitor as cod from leitor;

create view getMaiorLeitor as
	select count(em.codEmprestimo) as total, u.nome as nomeLeitor
    from emprestimo em, usuario u
    where u.codUsuario = em.codLeitor
    group by em.codLeitor 
    having total = (select count(*) as t 
					from emprestimo
					group by codleitor
                    order by t desc
                    limit 1);

create view livrosDisponiveis as
	select e.codexemplar as cod, l.titulo as t
    from exemplar e, livro l
    where e.codlivro = l.codlivro
    and e.emprestado = 0;

create view totalEmprestimosAluno as
	select u.nome as nome, count(e.codEmprestimo) as tot
    from usuario u, emprestimo e, leitor l
    where u.codusuario = l.codLeitor
    and l.codLeitor = e.codLeitor
    group by u.nome;

create view emprestimosPendentes as
    select e.codemprestimo as codEmprestimo, u.nome as nomeLeitor, li.titulo as tituloLivro,
    ex.codExemplar as exemplar, le.codLeitor as codLei
    from emprestimo e, exemplar ex, leitor le, usuario u, livro li 
    where e.codleitor = le.codleitor and
	le.codLeitor = u.codusuario and
	e.codexemplar = ex.codexemplar and
	ex.codLivro = li.codLivro and
	e.pendente = 1
    group by e.codemprestimo;

/* Procedures */
delimiter |

create procedure checkIfUserExists(in codusuario int) 
begin
    select * from usuario u
    where u.codUsuario = codusuario
    limit 1;
end;|

delimiter |
create procedure checkPassword(in senha varchar(40), in codusuario int)
begin
    select * from usuario u
    where u.senha = senha
    and u.codusuario = codusuario;
end;|

delimiter |
create procedure isFuncionario(in codusuario int)
begin
    select * from funcionario
    where codfunc = codusuario
    limit 1;
end;|

delimiter |
create procedure isLeitor (in codusuario int)
begin
	select * from leitor
    where codleitor = codusuario
    limit 1;
end;|

delimiter |
create procedure atualizarEmprestimo(in codEmp int, in aprovado int)
begin
    update emprestimo set aprovado = aprovado, pendente = 0, ocorrendo = aprovado where 
        codEmprestimo = codEmp;
end;|

delimiter |
create function cadastroUsuario
(cpf varchar(14), email varchar(90), nome varchar(90),  codCidade varchar(50), rua varchar(90), numero int, bairro varchar(90), senha varchar(40), estado int)

returns int

begin
	insert into usuario (cpf, email, nome, cidade, rua, numero, bairro, senha, uf)
		values (cpf, email, nome, codCidade, rua, numero, bairro, senha, estado);
        
	return (select usuario.codUsuario 
			from usuario
			where usuario.cpf = cpf);
end;|

delimiter |
create procedure cadastroLeitor (codusu int)

begin
	insert into leitor (codLeitor) values (codusu);
end;|

delimiter |
create procedure cadastroFuncionario (codusu int, carg varchar(30), turn varchar(10))

begin
	insert into funcionario (codFunc, cargo, turno) values (codusu, carg, turn);
end;|

delimiter |
create procedure cadastroEditora (nome varchar(50), cnpj varchar(19), telefone bigint, email varchar(90),
rua varchar (90), numero int, bairro varchar(90), cidade varchar(90), uf int)

begin
	insert into Editora (nome, cnpj, telefone, email, rua, numero, bairro, cidade, uf)
    values (nome, cnpj, telefone, email, rua, numero, bairro, cidade, uf);
end;|

delimiter |
create procedure cadastroAutor (cpf varchar(14), nome varchar(50), telefone bigint, email varchar(90),
rua varchar(90), numero int, bairro varchar(90), cidade varchar(90), uf int)

begin
	insert into autor (cpf, nome, telefone, email, rua, numero, bairro, cidade, uf)
    values (cpf, nome, telefone, email, rua, numero, bairro, cidade, uf);
end; |

delimiter |
create procedure cadastroExemplar (cod int, qtd int)
begin
	declare cont int;
    set cont = 0;
    
    while cont < qtd do
		insert into Exemplar (codLivro,emprestado) values (cod,false);
        set cont = cont + 1;
    end while;
end;|

delimiter |
create function cadastroLivro
(isbn varchar(14), titulo varchar(90), ed int, ano int, qtd int, gen int, descr varchar(255))

returns int

begin
	declare codigoLivro int;
	insert into livro (isbn, titulo, edicao, ano, qtdExemplar, genero, descricao) 
		values (isbn, titulo, ed, ano, qtd, gen, descr);
        
	select livro.codlivro into codigoLivro
			from livro
			where livro.isbn = isbn;

	call cadastroExemplar(codigoLivro, qtd);
    
    return codigoLivro;
end;|

delimiter |
create procedure cadastroGeralLivro (in livro int, in autor int, in editora int)

begin
	insert into cadlivro(codautor,codlivro,codeditora) values (autor, livro, editora);
end;|

delimiter |
create procedure addEmprestimo (in codemp int, in codlei int)
begin
	declare totalEmp int;
	insert into emprestimo(codExemplar, codLeitor, dtEmprestimo, dtPrevista, pendente, aprovado, ocorrendo)
		values(codemp, codlei, CURDATE(), (CURDATE() + interval 14 day), 1, 0, 0);
        
	call updateEmprestimoExemplar(codemp, 1);
        
	set totalEmp = (select qtdEmprestimos from leitor
					where codLeitor = codlei);
	
    set totalEmp = totalEmp + 1;
    
    call updateEmprestimoLeitor (codlei, totalEmp);
end;|

delimiter |
create procedure updateEmprestimoExemplar (in codemp int, in empres int)
begin
	update exemplar set emprestado = empres
		where codExemplar = codemp;
end;|

delimiter |
create procedure updateEmprestimoLeitor (in codlei int, in totalEmp int)
begin
	update leitor set qtdEmprestimos = totalEmp
		where codleitor = codlei;
end;|

delimiter |
create procedure upPendente (in codEmpr int, in pend int, in aprov int, in ocorr int)
begin
	update emprestimo set pendente = pend, aprovado = aprov, ocorrendo = ocorr
    where codEmprestimo = codEmpr;
end;|

delimiter |
create procedure devolver (in codEmp int, in emp int, in codLei int, in codEx int)
begin
	update emprestimo set ocorrendo = 0
	where codEmprestimo = codEmp;
    
    call updateEmprestimoLeitor(codLei, emp);
    
    update exemplar set emprestado = 0
    where codExemplar = codEx;
    
    insert into devolucao(codEmprestimo,dtDevolucao)
    values (codEmp, curdate());
end;|