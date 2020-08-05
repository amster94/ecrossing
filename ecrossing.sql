create database ecrossing;
use ecrossing;

/*======================= 1. ECROSSING ADMIN TABLE ==========================================*/
CREATE TABLE IF NOT EXISTS ecrossing_admin(
ecrossing_admin_id INT(10) AUTO_INCREMENT NOT NULL,
admin_email VARCHAR(30) NOT NULL,
admin_password VARCHAR(30) NOT NULL,
admin_name VARCHAR(30) NOT NULL,
admin_activated enum('0','1') DEFAULT '1',
UNIQUE KEY (ecrossing_admin_id),
PRIMARY KEY(admin_email)
);

/*======================= 2. ECROSSING CLIENT TABLE ==========================================*/
CREATE TABLE IF NOT EXISTS ecrossing_client(
ecrossing_client_id INT(10) AUTO_INCREMENT NOT NULL,
client_date DATETIME,
client_email VARCHAR(30) NOT NULL,
client_password VARCHAR(30) NOT NULL,
client_name VARCHAR(30) NOT NULL,
total_request_generated INT(10) NOT NULL DEFAULT 0,
total_employees_generated INT(10) NOT NULL DEFAULT 0,
client_activated enum('0','1') DEFAULT '1',
UNIQUE KEY (ecrossing_client_id),
PRIMARY KEY(client_email)
);

/*======================= 3. ECROSSING REQUEST TABLE ==========================================*/
CREATE TABLE IF NOT EXISTS ecrossing_client_request(
ecrossing_request_id INT(10) AUTO_INCREMENT NOT NULL,
client_request_date DATETIME,
request_unique_id VARCHAR(20) NOT NULL,
client_email VARCHAR(30) NOT NULL,
request_employees INT(10) NOT NULL DEFAULT 0,
request_status enum('Pending','In Progress','Reviewing','Complete') DEFAULT 'Pending',
UNIQUE KEY (ecrossing_request_id),
PRIMARY KEY(request_unique_id),
FOREIGN KEY (client_email) REFERENCES ecrossing_client(client_email) ON DELETE CASCADE ON UPDATE CASCADE
);

/*======================= 4. ECROSSING EMPLOYEE TABLE ==========================================*/
CREATE TABLE IF NOT EXISTS ecrossing_client_employee(
ecrossing_employee_id INT(10) AUTO_INCREMENT NOT NULL,
client_employee_date DATETIME,
client_email VARCHAR(30) NOT NULL,
request_unique_id VARCHAR(20) NOT NULL,
employee_unique_id VARCHAR(20) NOT NULL,
employee_name VARCHAR(30) NOT NULL,
total_files_uploaded INT(10) NOT NULL DEFAULT 0,
employee_status enum('White','Gray','Red','Green','Orange') DEFAULT 'White',
download_employee_report VARCHAR(150) NOT NULL DEFAULT '',
UNIQUE KEY (ecrossing_employee_id),
FOREIGN KEY (request_unique_id) REFERENCES ecrossing_client_request(request_unique_id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (client_email) REFERENCES ecrossing_client(client_email) ON DELETE CASCADE ON UPDATE CASCADE
);

/*======================= 5. ECROSSING ADMIN NOTIFICATION ==========================================*/
CREATE TABLE IF NOT EXISTS ecrossing_admin_notification(
ecrossing_notification_id INT(10) AUTO_INCREMENT NOT NULL,
notification_date DATETIME,
client_email VARCHAR(30) NOT NULL,
request_unique_id VARCHAR(20) NOT NULL,
request_employees INT(10) NOT NULL DEFAULT 0,
UNIQUE KEY (ecrossing_notification_id),
FOREIGN KEY (request_unique_id) REFERENCES ecrossing_client_request(request_unique_id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (client_email) REFERENCES ecrossing_client(client_email) ON DELETE CASCADE ON UPDATE CASCADE
);

/*======================= 5. ECROSSING UPLOAD TABLE ==========================================*/
CREATE TABLE IF NOT EXISTS ecrossing_client_upload(
ecrossing_upload_id INT(10) AUTO_INCREMENT NOT NULL,
request_unique_id VARCHAR(20) NOT NULL,
employee_unique_id VARCHAR(20) NOT NULL,
employee_name VARCHAR(30) NOT NULL,
file_upload_location VARCHAR(150) NOT NULL,
UNIQUE KEY (ecrossing_upload_id),
FOREIGN KEY (request_unique_id) REFERENCES ecrossing_client_request(request_unique_id) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (employee_unique_id) REFERENCES ecrossing_client_employee(employee_unique_id) ON DELETE CASCADE ON UPDATE CASCADE
);





