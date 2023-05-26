
-- db creation
drop database chat;
CREATE DATABASE chat;

-- using db
USE chat;

-- table for user types
CREATE TABLE user_types(
	user_type_id int primary key auto_increment,
    user_type_details varchar(50) not null unique	
);

-- insert for user types
INSERT into user_types VALUES
(	
	null,
    'normal'
),(	
	null,
    'admin'
),(	
	null,
    'sub-admin'
),(	
	null,
    'super-admin'
);
-- SELECT user_type_id
SELECT user_type_id FROM user_types 
WHERE user_type_details = 'normal';

-- table for user status
CREATE TABLE user_status(
	user_status_id int primary key auto_increment,
    user_status_details varchar(50) not null unique
);

-- insert for user status
INSERT INTO user_status VALUES
(
	null,
    'active'
),(
	null,
	'inactive'
),(
	null,
    'deleted'
);
 
-- SELECT user_status_id 
SELECT user_status_id FROM user_status
WHERE user_status_details = 'active';

-- table for gender
CREATE TABLE user_genders(
	user_gender_id tinyint primary key auto_increment,
    user_gender_details varchar(50) unique
);

-- insert for user gender
INSERT INTO user_genders VALUES
(
	null,
    'Prefer not to say'
),(
	null,
    'Male'
),(
	null,
    'Female'
),(
	null,
    'Other'
),(
	null,
    'Transgender'
),(
	null,
    'Gender neutral'
),(
	null,
    'Non-binary'
),(
	null,
    'Agender'
),(
	null,
    'Pangender'
),(
	null,
    'Genderqueer'
),(
	null,
    'Two-spirit'
),(
	null,
    'Third gender'
);



-- SELECT user gender id
SELECT user_gender_id FROM user_genders 
WHERE user_gender_details = 'Male';

-- SELECT * from genders
SELECT * FROM user_genders
ORDER BY user_gender_id 
LIMIT 20;

-- table for phone country code
CREATE TABLE user_phone_country_code(
	user_phone_country_code_id int primary key auto_increment,
    user_phone_contry_code_details VARCHAR(15)
);

-- insert for phone country code
INSERT INTO user_phone_country_code VALUES
(
	null,
    '+63'
);

-- SELECT user phone country code id 
SELECT user_phone_country_code_id FROM user_phone_country_code 
WHERE user_phone_contry_code_details ='+63';


-- table for users 
CREATE TABLE users(
	user_id int primary key auto_increment,
    user_status_id int NOT NULL,
    user_type_id int NOT NULL ,
    user_gender_id tinyint  NOT NULL,
    user_phone_country_code_id int  NOT NULL,
    user_phone_number VARCHAR(15)   NOT NULL,
    user_name_verified BOOL DEFAULT NULL,
    user_email_verified BOOL DEFAULT NULL,
    user_phone_verified BOOL DEFAULT NULL,
    user_valid_id_validated BOOL DEFAULT NULL,
    user_email VARCHAR(255)   NOT NULL,
    user_name VARCHAR(255)   NOT NULL,
    user_password_hashed VARCHAR(255)  NOT NULL,
    user_firstname VARCHAR(100)  NOT NULL,
    user_middlename VARCHAR(100)  NOT NULL,
    user_lastname VARCHAR(100)  NOT NULL,
    user_address VARCHAR(255) DEFAULT NULL,
	user_birthdate DATE NOT NULL, 
    user_valid_id_photo VARCHAR(100) DEFAULT 'default.png',
    user_profile_picture VARCHAR(100) DEFAULT 'default.png',
    user_date_created datetime DEFAULT CURRENT_TIMESTAMP,
    user_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_type_id) REFERENCES user_types(user_type_id),
	FOREIGN KEY (user_status_id) REFERENCES user_status(user_status_id),
    FOREIGN KEY (user_gender_id) REFERENCES user_genders(user_gender_id),
    FOREIGN KEY (user_phone_country_code_id) REFERENCES user_phone_country_code(user_phone_country_code_id)
);
CREATE INDEX idx_user_email ON users(user_email);
CREATE INDEX idx_user_name ON users(user_name);
CREATE INDEX idx_user_phone_number ON users(user_phone_number);
CREATE INDEX idx_user_password ON users(user_password_hashed);

 -- sign up
 
INSERT INTO users (user_id,user_status_id,user_type_id,user_gender_id,user_phone_country_code_id,user_phone_number,user_email,user_email_verified,
user_name,user_name_verified,user_password_hashed,user_firstname,user_middlename,user_lastname,user_address,user_birthdate,user_valid_id_photo,user_profile_picture,user_date_created,user_date_updated) VALUES(
	null,
    (SELECT user_status_id FROM user_status WHERE user_status_details = 'deleted'),
    (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal'),
    (SELECT user_gender_id FROM user_genders WHERE user_gender_details = 'Male'),
    (SELECT user_phone_country_code_id FROM user_phone_country_code WHERE user_phone_contry_code_details ='+63'),
    '09265827341',
    'hanz.dumapit52@gmail.com',
    true,
    'Drusha01',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Etrone',
    'Dumapit',
	'user address',
    ('2000-02-12'),
    'default.png',
    'default.png',
    now(),
	now()
    
);


-- online status
CREATE TABLE user_state(
	user_id int not null,
    user_status bool not null,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- login / verify credentials
SELECT user_id,user_password_hashed FROM users
WHERE user_name = BINARY 'Drusha01' OR (user_email = 'hanz.dumapit53@gmail.com' AND user_email_verified = 1) AND user_type_id= (SELECT user_type_id FROM user_types WHERE user_type_details = 'normal');

-- updating user creds 
UPDATE users
SET user_status_id =(SELECT user_status_id FROM user_status WHERE user_status_details = 'active')
WHERE user_id = 1;


-- Contact headers and options (to be finalized)
CREATE TABLE headers(
	header_id int primary key auto_increment,
	header_style int not null, -- foreign key
    header_setting int not null -- foreign key
);
-- Contact list
CREATE TABLE contacts(
	contact_id int primary key auto_increment,
    contact_owner_user_id int not null,
    contact_contact_user_id  int not null,
    contact_date_created datetime DEFAULT CURRENT_TIMESTAMP,
    contact_date_updated datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (contact_owner_user_id) REFERENCES users(user_id),
	FOREIGN KEY (contact_contact_user_id) REFERENCES users(user_id)
);

-- adding chats and adding contact
INSERT INTO contacts VALUES(
	null,1,1,now(),now()
);
 
 -- contact list
 SELECT contact_id,contact_owner_user_id,contact_contact_user_id 
 FROM contacts 
 WHERE contact_owner_user_id = 1;
  -- contact list with limit -- for optimization, etc
 SELECT contact_id,contact_owner_user_id,contact_contact_user_id 
 FROM contacts 
 WHERE contact_owner_user_id = 1
 LIMIT 20;
 
 -- table for content type 
 CREATE TABLE content_types(
	content_id int primary key auto_increment,
    content_details varchar(50) unique
 );
 
 INSERT INTO content_types VALUES
 ( 
);
-- table for chats
CREATE TABLE chats(
	chat_id int primary key auto_increment,
    chat_content_type int not null, -- default as text
    chat_content varchar(2048) not null,
    chat_contact_id int not null,
    chat_date_created datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_contact_id) REFERENCES contacts(contact_id),
    FOREIGN KEY (chat_content_type) REFERENCES content_types(content_id)
);
-- Chat history
SELECT chat_id,chat_content,chat_date_created
FROM chats
WHERE chat_contact_id = 1
ORDER BY chat_date_created DESC;


-- Chat composer
-- this will be part of insert in chat / first chat

-- first chat will add to contacts and create an event for notification

-- notification type table
CREATE TABLE notification_types(
	notification_type_id int primary key auto_increment,
    notification_details varchar(255)
);
-- notification icon table
CREATE TABLE notification_icons(
	notification_icon_id int primary key auto_increment,
    notification_icon_filename varchar(50) unique
);
-- Notification
CREATE TABLE Notifications(
	notification_id int primary key auto_increment,
    notification_content varchar(255),
    notification_type_id int not null,
    notification_icon_id int not null,
    notification_date_created datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (notification_type_id) REFERENCES notification_types(notification_type_id),
    FOREIGN KEY (notification_icon_id) REFERENCES notification_icons(notification_icon_id)
);


-- group chat
CREATE TABLE group_chats(
	group_chat_id int primary key auto_increment,
    group_chat_name varchar(255),
    group_chat_admin_id int not null,
    FOREIGN KEY (group_chat_admin_id) REFERENCES users(user_id)
);

-- group member roles
CREATE TABLE group_member_roles(
	group_member_role_id int primary key auto_increment,
    group_member_role_name varchar(50) unique
);
-- group chat members
CREATE TABLE group_members(
	group_member_id int primary key auto_increment,
    group_member_role_id int not null, -- fk
	group_member_date_added datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (group_member_role_id) REFERENCES group_member_roles(group_member_role_id)
);