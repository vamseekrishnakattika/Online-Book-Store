Languages/frameworks used:
•	PHP
•	HTML
•	CSS
•	JQuery
•	Ajax

Admin View:
In Admin view admin user can List all items, add new item, delete item or Update existing item. Admin users have the same interface with regular users, except they have extra features for update and deletion of products/services.
While adding items to the system, admin user will be able to upload pictures for the items and while updating items, will be able to change pictures.

For delete, soft-delete is implemented with the help of Flag column in the books table in the database.

User signup: 
For registering a new user to the system. Check the new username or email address if it’s already registered to the system using AJAX, next check if all mandatory fields are filled out. Check if password is strong enough. User passwords are hashed and hashed version of passwords is stored in the database.

Users must register in order to place orders or view order histories

User login:
Check if the username and password format is correct, then authenticate the user and redirect the user to the home page.

List available books in the system:
User is able to filter the results based on genre, price, and release date. Also Search function allows users to search by title or description. 

The paging functionality for listings has been implemented. 

Add item(s) to the cart and checkout:
Cart contains pricing for each book and the quantity and logged in users can place order, not logged in users will be redirected to the login page. The inventory is updated till we have the book in stock.
User will also be able to update items in the cart (remove items from the cart, update their quantity).

Order history:
Show the history of purchases or saved lists for the user.

