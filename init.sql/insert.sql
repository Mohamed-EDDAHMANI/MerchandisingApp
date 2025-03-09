
INSERT INTO roles (role) VALUES ('admin'); -- id = 1
INSERT INTO roles (role) VALUES ('manager'); -- id = 2
INSERT INTO roles (role) VALUES ('employee'); -- id = 3


INSERT INTO users (password, email, first_name, last_name, role_id)
VALUES 
  (SHA2('password', 256), 'admin@example.com', 'Admin', 'User', 1);
