<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/styles.css">

     <!-- FontAwesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100 justify-content-center px-2 login-row">
      <div class="col-12 col-sm-10 col-md-8 col-lg-5">
        <div class='card p-4 login-card shadow-sm login-card'>
          <h2 class='text-center mb-4'>Admin Login</h2>

          <?php if (isset($_GET['error'])): ?>
              <div class="alert alert-danger text-center">
                  <?= htmlspecialchars($_GET['error']) ?>
              </div>
          <?php endif; ?>

          <form action="authenticate.php" method="POST">
              <div class="mb-3">
                  <label for="email" class="form-label">Email:</label>
                  <input type="email" name="email" class="form-control" required>
              </div>

              <div class="mb-3">
                  <label for="password" class="form-label">Password:</label>
                  <input type="password" name="password" class="form-control" required>
              </div>

              <div class="d-flex justify-content-between flex-column flex-sm-row gap-2">
                  <button type="submit" class="btn btn-primary w-100 w-sm-50">Login</button>
                  <a href="index.php" class="btn btn-secondary w-100 w-sm-50">Cancel</a>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Bootstrap CDN JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYBBdMx3m8bzzp3f5f5rhzT9g8FF93zX2Q3EzI3BeFf4hK51/ZzJvB3J9" crossorigin="anonymous"></script>
</body>
</html>
