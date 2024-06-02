<!DOCTYPE html>
<style>
.logo {
  border-radius: 50%;
}
</style>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Static Navbar</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="m-4">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ffffff;">
        <div class="container-fluid">
           <a class="navbar-brand"  style="color:#001F3F;"  href="./">
                <img id = "logo" src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top logo" alt="" loading="lazy">
                <?php echo $_settings->info('short_name') ?>
                </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                     <a href="./?p=products" style="color:black;" class="nav-item nav-link">Products</a>
                  <a href="./?p=about" style="color:black;" class="nav-item nav-link">About</a>
                </div>
                <div class="navbar-nav ms-auto">
                     <a href="./admin" style="color:black;" class="nav-item nav-link"><b>Login</b></a>
                </div>
            </div>
        </div>
    </nav>
</div>
</body>
</html>