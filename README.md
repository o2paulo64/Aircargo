# Aircargo

Steps:

1. Clone/Download Repository
2. Using XAMPP as local server, move the downloaded repository to C:\xampp\htdocs. 
	Rename repository to 'Aircargo' if needed, such that the path is like this: 
	C:\xampp\htdocs\Aircargo
3. For the database to work, import Aircargo.sql and entity_data.sql from our CS165 Project Phase 4 Folder.  
	How?  
	a. Open xampp control panel  
	b. From the option on the right, open the terminal.  
	c. enter the following:   
	mysql -uroot    
	source /path/../Aircargo.sql   
	source /path/../entity_data.sql  
	*example script* source C:\Users\paulo\Google Drive\CS 165\CS 165 - MP Group Project\Phase 4\Aircargo.sql  
4. Open XAMPP control panel and start the Apache and MySQL module
5. On your web browser, preferably Google Chrome, enter the following URL: localhost/Aircargo
