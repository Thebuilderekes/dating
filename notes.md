
## conventions
- When using `require once`, use it with __DIR__ . "./[pathtoffile]"
- make sure that there isn't a sing space after ``<?php`` in all php files
- make sure that there is no echo or print statement before ``header()`` calls
- If you're editing files on Windows, sometimes the editor (like Notepad) adds a Byte Order Mark (BOM) at the start of the file, which is invisible but counts as output. Use a good code editor like VS Code, Sublime, or PHPStorm, and save the file without BOM.
- make sure that your column names match the names of the variables in the sql statement

To manage the **admin username and password securely via a `.env` file**, you'll load them into your app without hard-coding values. This is more secure and scalable.

---


Would you like the login form to allow **either a DB admin or an `.env` admin**, or just `.env` only?

======== new design


Based on your `UserController` structure and MVC setup, here’s how you can build an `AdminController` using the same pattern. It will:

* Use the existing `User` model.
* Allow an admin (a user with `is_admin = 1` or `role = 'admin'`) to log in and log out.
* View all registered users.
* Delete any user.

---

## TODO
-- make it so that the adminController uses an admin model that only has the ability to getallusers, delete users , login and logout instead of what it is currently doing which is using the user model instead, and then allowing every user the ability to do all what an admin can do.

