<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    <script type="text/javascript" src="/public/js/main.js"></script>
</head>
<body>
    <h1>Add new user</h1>
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" /><br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" /><br><br>
        <label for="password">Password:</label>
        <input type="text" id="password" /><br><br>
        <label for="birthday">Birthday:</label>
        <input type="text" id="birthday" /><br><br>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" /><br><br>
        <label for="url">Url:</label>
        <input type="text" id="url" /><br><br>
        <button type="button" id="add_user">Add User</button>
    </div>
    <div>
        <br><br>
        <a href="http://localhost:8080/public/user"><strong>All users</strong></a>
    </div>
</body>
</html>