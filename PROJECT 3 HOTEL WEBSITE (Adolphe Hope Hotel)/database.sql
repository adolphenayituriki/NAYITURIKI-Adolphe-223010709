-- Adolphe HOPE Hotel Database Setup
-- Run this script to create the database and tables

-- Create database
CREATE DATABASE IF NOT EXISTS hotel_db;
USE hotel_db;

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    menu_item VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    order_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create messages table
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    location VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create admin table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert default admin (username: admin, password: admin123)
INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

-- Insert sample menu items for demonstration
INSERT INTO orders (full_name, email, phone, menu_item, address, order_date) VALUES
('NAYITURIKI Adolphe', 'www.nayituriki.com@gmail.com', '0728390015', 'Grilled Salmon', '123 Main St', '2024-01-15'),
('MUYISINGIZEMWESE Evode', 'muyisingizemwese@gmail.com', '0788990011', 'Fresh Orange Juice', '456 Oak Ave', '2024-01-16');

-- Insert sample messages for demonstration
INSERT INTO messages (full_name, email, phone, location, message) VALUES
('NAYITURIKI Adolphe', 'www.nayituriki.com@gmail.com', '0728390015', 'New York', 'Great service!'),
('MUYISINGIZEMWESE Evode', 'muyisingizemwese@gmail.com', '0788990011', 'Los Angeles', 'Love the food!');