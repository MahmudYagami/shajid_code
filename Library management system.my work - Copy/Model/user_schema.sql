
ALTER TABLE users
ADD id_proof VARCHAR(255) AFTER email,
ADD library_card_number VARCHAR(20) DEFAULT NULL AFTER password,
ADD status ENUM('pending', 'approved') DEFAULT 'pending' AFTER role;
