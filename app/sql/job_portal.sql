CREATE DATABASE IF NOT EXISTS job_portal CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE job_portal;

CREATE TABLE users (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,email VARCHAR(150) UNIQUE NOT NULL,password VARCHAR(255) NOT NULL,role ENUM('candidate','employer','admin') DEFAULT 'candidate',created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE categories (id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL UNIQUE);
CREATE TABLE jobs (id INT AUTO_INCREMENT PRIMARY KEY,employer_id INT NOT NULL,category_id INT NOT NULL,title VARCHAR(180) NOT NULL,location VARCHAR(150) NOT NULL,salary VARCHAR(100),job_type VARCHAR(50) DEFAULT 'Toàn thời gian',description TEXT NOT NULL,deadline DATE NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(employer_id) REFERENCES users(id) ON DELETE CASCADE,FOREIGN KEY(category_id) REFERENCES categories(id));
CREATE TABLE applications (id INT AUTO_INCREMENT PRIMARY KEY,job_id INT NOT NULL,user_id INT NOT NULL,cover_letter TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,UNIQUE KEY unique_apply(job_id,user_id),FOREIGN KEY(job_id) REFERENCES jobs(id) ON DELETE CASCADE,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE);

INSERT INTO categories(name) VALUES ('Công nghệ thông tin'),('Marketing'),('Kinh doanh'),('Thiết kế'),('Kế toán - Tài chính'),('Nhân sự'),('Chăm sóc khách hàng'),('Logistics');
-- Mật khẩu demo của admin: Admin@123 (hash cần tạo lại nếu thay đổi)
INSERT INTO users(name,email,password,role) VALUES ('Quản trị viên','admin@gmail.com','123456','admin');
