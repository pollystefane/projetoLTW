<?php
$db = new SQLite3('database/freelancer.db');

// Tabela de usuários
$db->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    senha TEXT NOT NULL,
    tipo TEXT NOT NULL CHECK (tipo IN ('cliente', 'freelancer'))
)");

echo "Banco de dados e tabela criados com sucesso.";
?>
