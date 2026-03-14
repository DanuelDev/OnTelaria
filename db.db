CREATE SCHEMA IF NOT EXISTS ontelaria;
USE ontelaria;

CREATE TABLE hospedes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(20),
    cpf VARCHAR(14) UNIQUE,
    data_nascimento DATE,
    endereco TEXT,
    senha VARCHAR(100)
);

CREATE TABLE funcionarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    setor VARCHAR(50) NOT NULL,
    cpf VARCHAR(100) UNIQUE,
    senha VARCHAR(100)
);

CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    cpf VARCHAR(100) UNIQUE,
    senha VARCHAR(100)
);

CREATE TABLE quartos (
	id INT PRIMARY KEY AUTO_INCREMENT,
    hospede_id INT,
    numero VARCHAR(10) NOT NULL UNIQUE,
    tipo VARCHAR(50) NOT NULL,
    capacidade INT NOT NULL,
    preco_diaria DECIMAL(10, 2) NOT NULL,
    descricao TEXT,
    status ENUM('disponivel', 'indisponivel', 'manutencao') DEFAULT 'disponivel'
);

CREATE TABLE reservas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    hospede_id INT NOT NULL,
    -- Novos campos de identificação e contato
    nome_completo VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(100),
    cpf_passport VARCHAR(50),
    -- Campo de contagem
    quantidade_total_pessoas INT DEFAULT 1,
    -- Campos de período e status
    data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL,
    status ENUM('pendente', 'confirmada', 'cancelada', 'concluida') DEFAULT 'pendente',
    valor_total DECIMAL(10,2),
    -- Observações (já existente)
    observacoes TEXT,
    -- Restrições
    FOREIGN KEY (hospede_id) REFERENCES hospedes(id) ON DELETE CASCADE,
    CHECK (data_fim > data_inicio)
);

INSERT INTO reservas (
    hospede_id, 
    nome_completo, 
    telefone, 
    email, 
    cpf_passport, 
    quantidade_total_pessoas, 
    data_inicio, 
    data_fim, 
    status, 
    valor_total, 
    observacoes
) VALUES (
    1,                                -- hospede_id (ID vindo da tabela hospedes)
    'Gabriel Souza Silva',            -- nome_completo
    '+55 11 99999-8888',              -- telefone
    'gabriel.silva@email.com',        -- email
    '123.456.789-00',                 -- cpf_passport
    3,                                -- quantidade_total_pessoas
    '2026-05-10',                     -- data_inicio (Formato AAAA-MM-DD)
    '2026-05-15',                     -- data_fim
    'confirmada',                     -- status
    1250.00,                          -- valor_total
    'Hóspede solicitou andar alto e cama extra de solteiro.' -- observacoes
);

ALTER TABLE reservas 
    ADD COLUMN nome_completo VARCHAR(255) NOT NULL AFTER hospede_id,
    ADD COLUMN telefone VARCHAR(20) AFTER nome_completo,
    ADD COLUMN email VARCHAR(100) AFTER telefone,
    ADD COLUMN cpf_passport VARCHAR(50) AFTER email,
    ADD COLUMN quantidade_total_pessoas INT DEFAULT 1 AFTER cpf_passport;

CREATE TABLE estadias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    reserva_id INT NOT NULL,
    quarto_id INT NOT NULL,
    data_checkin DATETIME,
    data_checkout DATETIME,
    status ENUM('ativa', 'concluida', 'cancelada') DEFAULT 'ativa',
    valor_estadia DECIMAL(10,2),
    observacoes TEXT,
    FOREIGN KEY (reserva_id) REFERENCES reservas(id) ON DELETE CASCADE,
    FOREIGN KEY (quarto_id) REFERENCES quartos(id) ON DELETE RESTRICT
);

-- -----------------------------------------------------
-- Valores iniciais de quartos
-- -----------------------------------------------------

INSERT INTO quartos (numero, tipo, capacidade, preco_diaria) VALUES 
(1,  'suite',           3, 100.00),
(2,  'suite',           3, 100.00),
(3,  'luxotriplo',      4, 300.00),
(4,  'luxotriplo',      4, 300.00),
(5,  'luxoduplo',       4, 200.00),
(6,  'luxoduplo',       4, 200.00),
(7,  'luxocasal',       2,  50.00),
(8,  'luxocasal',       2,  50.00),
(9,  'suiteconjugada',  5, 600.00),
(10, 'suiteconjugada',  5, 600.00),
(11, 'apartamentomini', 6, 1000.00),
(12, 'apartamentomini', 6, 1000.00);

-- -----------------------------------------------------
-- Valores iniciais de hóspedes e funcionários
-- senhas: 123
-- -----------------------------------------------------

-- Para a tabela hospedes
INSERT INTO ontelaria.hospedes 
(nome, email, telefone, cpf, data_nascimento, endereco, senha) 
VALUES 
('Cliente Chatonildo', 
 'cliente@email.com', 
 '19446584', 
 '4554648385', 
 '2025-11-18', 
 'Rua Muito Engraçada, Santa Catarina, CEP: 4546486', 
 '$2a$10$G84fota5R8s5FIGVIjaDMuTg8f9uMZje9KZXbl1biqzLoIAkIzgKy');

-- Para a tabela funcionarios
INSERT INTO ontelaria.funcionarios 
(nome, email, setor, cpf, senha) 
VALUES 
('Funcionário dos Santos', 
 'funcionario@email.com', 
 'Registro', 
 '654894256', 
 '$2y$10$/mN4DWqP8eEk0EHc3eQLJO94nZzVGkG0wSJKQF2V6P5keLcZ7Gvte');