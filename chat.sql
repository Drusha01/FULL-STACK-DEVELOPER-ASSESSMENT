
-- db creation
drop database chat;
CREATE DATABASE chat;

-- using db
USE chat;

-- table for users
CREATE TABLE users(
	user_id int primary key auto_increment,
    user_name varchar(255) not null ,
    user_email varchar(255) not null ,
    user_name_verified BOOL DEFAULT NULL,
    user_email_verified BOOL DEFAULT NULL,
    user_password varchar(255) not null,
    user_firstname varchar(255) not null,
    user_lastname varchar(255) not null,
    user_profile varchar(255) default 'default.png'
);


-- online status
CREATE TABLE user_state(
	user_id int not null,
    user_status bool not null,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
-- login / verify credentials
-- INSERT INTO users VALUES(
-- 	null,'Drusha01','$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI','Hanrickson','Dumapit'
-- );

SELECT * FROM users;
SELECT * FROM users WHERE binary user_name  ="Drusha01";
SELECT user_id FROM users WHERE  user_email ='hanz.dumapit53@gmail.com' AND user_email_verified = true;

INSERT INTO users (user_name,user_name_verified,user_email,user_email_verified,user_password,user_firstname,user_lastname,user_profile) VALUES(
	'Drusha01',
	true,
    'hanz.dumapit53@gmail.com',
    true,
    '$argon2i$v=19$m=65536,t=4,p=1$eTZlMnMuV051aWVqVFdwTg$BoJu46kCpm6cJOPAgmzBul3gR2/tlvf8HFROQVLAqaI',
    'Hanrickson',
    'Dumapit',
    'default.png'
);

UPDATE users
SET user_lastname ='Hanrickson', user_lastname ='Dumapit'
WHERE user_id ='1';


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
 (null,'text'),
 (null,'file'),
 (null,'image'),
 (null,'video');
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

INSERT INTO chats VALUES
(null,1,'Hi Hanrickson',1,now());

-- Chat history
SELECT chat_id,chat_content,chat_date_created
FROM chats
WHERE chat_contact_id = 1
ORDER BY chat_date_created DESC;

SELECT distinct(contact_contact_user_id),user_name,user_firstname,user_lastname FROM chats
LEFT OUTER JOIN contacts ON chats.chat_contact_id=contacts.contact_id
LEFT OUTER JOIN users ON contacts.contact_owner_user_id=users.user_id


;


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