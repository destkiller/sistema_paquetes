-- Base de datos de entregas
CREATE DATABASE IF NOT EXISTS entregas CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE entregas;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','repartidor','cliente') NOT NULL DEFAULT 'cliente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    origin VARCHAR(150) NOT NULL,
    destination VARCHAR(150) NOT NULL,
    delivery_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
    status ENUM('recibido','en_transito','entregado') NOT NULL DEFAULT 'recibido',
    assigned_to INT DEFAULT NULL,
    customer_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO users (name, email, password, role) VALUES
('Administrador', 'admin@entregas.local', 'Admin123', 'admin'),
('Repartidor Demo', 'repartidor@entregas.local', 'Repartidor123', 'repartidor'),
('Cliente Demo', 'cliente@entregas.local', 'Cliente123', 'cliente');

INSERT IGNORE INTO packages (code, description, origin, destination, delivery_fee, status, customer_id) VALUES
('PKG-001', 'Entrega de documentos', 'Oficina central', 'Residencia', 15.00, 'recibido', 3),
('PKG-002', 'Paquete comercial', 'Bodega', 'Cliente final', 25.00, 'recibido', 3);
