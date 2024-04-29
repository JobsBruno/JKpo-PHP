create database jogodados;
use jogodados;

CREATE TABLE resultados (
  id_jogada int(11) NOT NULL,
  jogada_jogador varchar(255) NOT NULL,
  jogador_nome varchar(255) NOT NULL,
  computador varchar(255) NOT NULL,
  resultado varchar(255) NOT NULL
);