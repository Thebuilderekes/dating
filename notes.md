
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

    header("Location: /home");
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

## TESTING

