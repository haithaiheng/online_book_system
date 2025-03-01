<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Login</title>
    
</head>
<body>
<form method="post" action="./services/login.php">
  <div class="container-fluid h-100 mx-auto">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-3 col-sm-6 col-md-6 col-lg-4 col-xl-3 border border-secondary p-3">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">Ex: admin@example.com</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
  </div>
</form>
</body>
</html>