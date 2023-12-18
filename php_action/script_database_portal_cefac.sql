create database portal_cefac
default character set utf8
default collate utf8_general_ci;

create table usuarios(
id_usuario int auto_increment NOT NULL,
n_processo_usuario int NOT NULL,
nome_usuario varchar(50) NOT NULL,
senha_usuario varchar(100) NOT NULL,
email_usuario varchar(100) NOT NULL,
primary key(id_usuario)
)engine=InnoDB;

create table notas(
id_notas int auto_increment NOT NULL,
nome_aluno varchar(100) NOT NULL,
disciplina varchar(50) NOT NULL,
trimestre int NOT NULL,
primeira_nota float NOT NULL,
segunda_nota float NOT NULL,
primary key(id_notas)
)engine=InnoDB;

create table apresentacao(
id_apresentacao int auto_increment NOT NULL,
titulo_apresentacao varchar(100) NOT NULL,
disciplina_apresentacao varchar(50) NOT NULL,
data_upload_apresentacao date NOT NULL,
caminho_apresentacao varchar(100) NOT NULL,
primary key(id_apresentacao)
)engine=InnoDB;

create table livros(
id_livro int auto_increment NOT NULL,
autor_livro varchar(100) NOT NULL,
titulo_livro varchar(100) NOT NULL,
categoria_livro varchar(50) NOT NULL,
ano_publicacao_livro int NOT NULL,
data_upload_livro date NOT NULL,
caminho_livro varchar(100) NOT NULL,
primary key(id_livro)
)engine=InnoDB;