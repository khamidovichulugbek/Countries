<?php $view->components('start') ?>
<?php $view->components('navbar') ?>

<div class="d-flex justify-content-center text-center">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Profilni tahrirlash</h5>
            <form action="/profile" method="post">
                <input type="hidden" name="id" value="<?php echo $auth->users()->id(); ?>" />
                <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" value="<?php echo $auth->users()->firstName();?>" name="first_name" class="form-control">
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
                    <input type="text"  value="<?php echo $auth->users()->surname();?>" name="surname" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" value="<?php echo $auth->users()->username();?>" name="username" class="form-control">
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
                    <input type="email" name="email" value="<?php echo $auth->users()->email();?>" class="form-control">
                    <?php if ($this->session->has('email')) { ?>
                        <?php foreach ($this->session->getFlash('email') as $error) { ?>
                        <ul class="text-danger">
                            <li><?php echo $error ?></li>
                        </ul>
                        <?php } ?>
                    <?php }?>
                </div>

                <div class="mb-3 d-flex">
                    <a href="#" class="text-dark">Parolni o'zgartirish </a>
                </div>
                <button type="submit" class="btn btn-primary">Profilni tahirlash</button>
            </form>
        </div>
    </div>
</div>

<?php $view->components('end') ?>