
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
```php
   public function deleteUserById(int $id): bool
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $deleteId = $u['user_id'];
     $this->userModel->deleteUserById($deleteId);

    }
}
```
## TODO
-- make it so that the adminController uses an admin model that only has the ability to getallusers, delete users , login and logout instead of what it is currently doing which is using the user model instead, and then allowing every user the ability to do all what an admin can do.

To make your PHP login system "remember" the user until they explicitly log out, even after the browser is closed, you need to implement a **"Remember Me"** feature using **persistent login cookies**.

Here’s a step-by-step guide:

---

### ✅ 1. Add a "Remember Me" checkbox to your login form

```php
<form method="POST" action="/login">
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label>
    <button type="submit">Login</button>
</form>
```

---

### ✅ 2. Update your login logic

In your `UserController::login()` method:

```php
if ($user) {
    $_SESSION['user_id'] = $user['user_id'];

    if (!empty($_POST['remember'])) {
        // Create a random token
        $token = bin2hex(random_bytes(32));
        $expiry = time() + (86400 * 30); // 30 days

        // Save token in DB (associate with user)
        setcookie("remember_token", $token, $expiry, "/", "", false, true);

        // Save in DB
        $this->userModel->storeRememberToken($user['user_id'], $token, $expiry);
    }

    header("Location: /profile");
    exit;
}
```

---

### ✅ 3. In your `User` model, add a method like:

```php
public function storeRememberToken($userId, $token, $expiry)
{
    $stmt = $this->pdo->prepare("UPDATE dating_app_user SET remember_token = ?, token_expiry = ? WHERE user_id = ?");
    return $stmt->execute([$token, date('Y-m-d H:i:s', $expiry), $userId]);
}
```

Make sure your database table `dating_app_user` has:

```sql
ALTER TABLE dating_app_user 
ADD remember_token VARCHAR(64), 
ADD token_expiry DATETIME;
```

---

### ✅ 4. Check for the cookie on every request (e.g. in `session.php`)

```php
session_start();

if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    require_once __DIR__ . '/app/models/User.php';
    $userModel = new User();

    $user = $userModel->getUserByToken($_COOKIE['remember_token']);

    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
    }
}
```

And add this method to your `User` model:

```php
public function getUserByToken($token)
{
    $stmt = $this->pdo->prepare("SELECT * FROM dating_app_user WHERE remember_token = ? AND token_expiry > NOW()");
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
```

---

### ✅ 5. Clear the cookie on logout

```php
public function logout()
{
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, "/");
    }

    session_destroy();
    header("Location: /login");
    exit;
}
```

---

### 🔐 Security Tips

* Always use `HttpOnly` and `Secure` flags with `setcookie()` in production.
* Rotate tokens on each login for better security (optional).

Would you like me to generate all the code snippets and database schema in one place?
To create a reusable wrapper HTML template with a **footer** and a section where forms can be injected dynamically, you can use PHP to include a common header and footer, while injecting specific content (e.g., forms) inside a `<main>` tag.

Here’s how you can structure it:

---

### 1. **Create a Common Template File (`template.php`)**

This will be your wrapper HTML file, which contains the general layout (header, footer) and a placeholder for dynamic content (the form content will go inside the `<main>` tag).

#### `template.php`

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        main {
            padding: 20px;
            margin-bottom: 40px; /* Space for the footer */
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>

    <main>
        <!-- This is where the form or page content will be injected -->
        <?php echo $content; ?>
    </main>

    <footer>
        <p>&copy; 2025 Your Website. All rights reserved.</p>
    </footer>
</body>
</html>
```

### 2. **Create PHP Files for Your Forms**

Next, you can create the individual PHP files that will be injected into the template. These PHP files will contain the specific forms or content you want to display within the `main` section.

#### `login.php`

```php
<form method="POST" action="admin_login.php">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Login</button>
</form>
```

#### `dashboard.php`

```php
<h2>Welcome to the Admin Dashboard</h2>
<p>Here you can manage users and view the system data.</p>
<!-- Other content specific to the dashboard can be added here -->
```

### 3. **Include the Template and Inject Content**

In each PHP file that needs to use the template (such as `admin_login.php` or `admin_dashboard.php`), you’ll include the template and pass the specific content (the form or page) to it.

#### `admin_login.php`

```php
<?php
// Simulate fetching content (e.g., login form)
$content = include 'login.php';

// Include the template and pass the content to be injected
include 'template.php';
```

#### `admin_dashboard.php`

```php
<?php
// Simulate fetching content (e.g., dashboard content)
$content = include 'dashboard.php';

// Include the template and pass the content to be injected
include 'template.php';
```

---

### How it Works:

* **`template.php`** is your base layout containing the structure (header, footer, etc.).
* In each specific PHP file (like `admin_login.php` or `admin_dashboard.php`), you assign the content to a `$content` variable.
* The `include 'template.php';` will render the page with the dynamic `$content` inside the `<main>` section.

This approach allows you to maintain a consistent layout across different pages (such as forms or dashboards) while easily injecting custom content.

### Optional: Add More Customization

If you want to handle dynamic page titles, you could also modify the `<title>` in the template:

```php
<title><?php echo isset($pageTitle) ? $pageTitle : 'Default Title'; ?></title>
```

Then in the individual files, you can set `$pageTitle` before including the template:

```php
$pageTitle = 'Admin Login';
$content = include 'login.php';
include 'template.php';
```

---

Would you like to enhance this template with any specific features, such as error handling, validation messages, or session-based navigation?
