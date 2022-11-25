<?php

class Conexao
{
  public static function conectar()
  {
    /*
      $variavel = new PDO(
        tipo:host=local; 
        dbname=nome do banco,
        usuário de acesso ao banco, 
        senha de acesso ao banco
      )
    */
    $server = "0.tcp.sa.ngrok.io:13041";
    $database = "bddicadavovo2";
    $user = "root";
    $password = "";

    // conexão local
    $conexao = new PDO(
      "mysql:host=$server;
      dbname=$database",
      $user,
      $password
    );

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("SET CHARACTER SET utf8");

    return $conexao;
  }
}