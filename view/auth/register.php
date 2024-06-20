<?php $view->components('start') ?>
<?php $view->components('navbar') ?>

<div class="d-flex justify-content-center text-center">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Ro'yxatdan o'tish</h5>
            <form action="/register" method="post">
                <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" name="first_name" class="form-control">
                    <?php if ($this->session->has('first_name')) { ?>
                        <?php foreach ($this->session->getFlash('first_name') as $error) { ?>
                        <ul class="text-danger">
                            <li><?php echo $error ?></li>
                        </ul>
                        <?php } ?>
                    <?php }?>
                     
                </div>
                <div class="mb-3">
                    <label class="form-label">Surname</label>
                    <input type="text" name="surname" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control">
                    <?php if ($this->session->has('username')) { ?>
                        <?php foreach ($this->session->getFlash('username') as $error) { ?>
                        <ul class="text-danger">
                            <li><?php echo $error ?></li>
                        </ul>
                        <?php } ?>
                    <?php }?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control">
                    <?php if ($this->session->has('email')) { ?>
                        <?php foreach ($this->session->getFlash('email') as $error) { ?>
                        <ul class="text-danger">
                            <li><?php echo $error ?></li>
                        </ul>
                        <?php } ?>
                    <?php }?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirmation Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    <?php if ($this->session->has('password')) { ?>
                        <?php foreach ($this->session->getFlash('password') as $error) { ?>
                        <ul class="text-danger">
                            <li><?php echo $error ?></li>
                        </ul>
                        <?php } ?>
                    <?php }?>
                </div>
                <button type="submit" class="btn btn-primary">Ro'yxatdan o'tish</button>
            </form>
        </div>
    </div>
</div>

<?php $view->components('end') ?>