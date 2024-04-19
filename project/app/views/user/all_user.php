<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="/public/css/all_user.css">
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    <script type="text/javascript" src="/public/js/list.js"></script>
</head>
<body>
    <h1>All users</h1>
    <div>
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
            <? $index = 0; ?>
            <? foreach($data as $row): ?>
                <tr class="<?=$index%2 ? 'odd':'even'?>">
                    <td><span class="show" data-id="<?=$row['id']?>"><?=$row['username']?></span></td>
                    <td><?=$row['email']?></td>
                    <td><button type="button" class="delete" data-id="<?=$row['id']?>">Delete</button></td>
                </tr>
                <? $index++ ?>
                <? endforeach ?>
        </table>
    </div>
    <div>
        <br><br>
        <a href="http://localhost:8080/public/"><strong>Add user</strong></a>
    </div>
  
    <div id="container">
<div id="exampleModal" class="reveal-modal">
     <h2>User Data</h2>
     <p>
        Username: <span id="un"></span><br><br>
        Email: <span id="email"></span><br><br>
        Password: <span id="pwd"></span><br><br>
        Birthday: <span id="date"></span><br><br>
        Phone: <span id="phone"></span><br><br>
        Url: <span id="url"></span><br><br>
    </p>
    <span class="close-reveal-modal">Close</span>
</div>
</div>
</body>
</html>