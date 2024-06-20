<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
            </ul>
            <?php if ($auth->check()) { ?>
                <a href="/profile" class="text-dark m-2"><?php echo $auth->users()->firstName() ?></a>
                <form class="d-flex" action="/logout" method="post">
                    <button class="btn btn-outline-danger" type="submit">Logout</button>
                </form>
            <?php } else { ?>
                <div class="m2">
                    <a href="/register" class="btn btn-outline-primary">Register</a>
                    <a href="/login" class="btn btn-primary">Login</a>
                </div>

            <?php } ?>
        </div>
    </div>
</nav>

<div class="container mt-2">