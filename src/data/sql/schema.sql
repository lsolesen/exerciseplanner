CREATE TABLE sf_guard_user (id INT AUTO_INCREMENT, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME, updated_at DATETIME, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id INT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id INT, permission_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id INT, permission_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id INT, group_id INT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id INT AUTO_INCREMENT, user_id INT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME, updated_at DATETIME, INDEX user_id_idx (user_id), PRIMARY KEY(id, ip_address)) ENGINE = INNODB;
CREATE TABLE exercise_set (id INT UNSIGNED AUTO_INCREMENT, otype TINYINT UNSIGNED, s1 VARCHAR(32), i1 INT UNSIGNED, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE program_exercise (id INT UNSIGNED AUTO_INCREMENT, program_id INT UNSIGNED, exercise_set_id INT UNSIGNED, INDEX program_id_idx (program_id), INDEX exercise_set_id_idx (exercise_set_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE exercise_links (id INT UNSIGNED AUTO_INCREMENT, exercise_id INT UNSIGNED, related_exercise_id INT UNSIGNED, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE exercise_muscles (id INT UNSIGNED AUTO_INCREMENT, exercise_id INT UNSIGNED, muscle_id INT UNSIGNED, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE profile (id BIGINT AUTO_INCREMENT, sf_guard_user_id INT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255), notes TEXT, INDEX sf_guard_user_id_idx (sf_guard_user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE exercises (id INT UNSIGNED AUTO_INCREMENT, created_at DATETIME, updated_at DATETIME, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE exercise_translation (id INT UNSIGNED, name VARCHAR(30), description TEXT, lang CHAR(2), PRIMARY KEY(id, lang)) ENGINE = INNODB;
CREATE TABLE muscles (id INT UNSIGNED AUTO_INCREMENT, name VARCHAR(255), insertio VARCHAR(255), origio VARCHAR(255), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE program_translation (id INT UNSIGNED, name VARCHAR(32), notes TEXT, lang CHAR(2), PRIMARY KEY(id, lang)) ENGINE = INNODB;
CREATE TABLE program (id INT UNSIGNED AUTO_INCREMENT, sf_guard_user_id INT, created_at DATETIME, updated_at DATETIME, INDEX sf_guard_user_id_idx (sf_guard_user_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE program_exercise ADD FOREIGN KEY (program_id) REFERENCES program(id) ON DELETE CASCADE;
ALTER TABLE program_exercise ADD FOREIGN KEY (exercise_set_id) REFERENCES exercise_set(id) ON DELETE CASCADE;
ALTER TABLE profile ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE exercise_translation ADD FOREIGN KEY (id) REFERENCES exercises(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE program_translation ADD FOREIGN KEY (id) REFERENCES program(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE program ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
