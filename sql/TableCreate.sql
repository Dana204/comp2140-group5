USE MaintainDb;
CREATE TABLE maintain(
   id INT AUTO_INCREMENT,
   name VARCHAR(64),
   department VARCHAR(64),
   email VARCHAR(64),
   area VARCHAR(64),
   location VARCHAR(64),
   description VARCHAR(256),
   category VARCHAR(64),
   status VARCHAR(64),
   PRIMARY KEY(id));	
