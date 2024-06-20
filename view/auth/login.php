<?php $view->components('start') ?>
<?php $view->components('navbar') ?>

<div class="d-flex justify-content-center text-center">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Tizimga kirish</h5>
            <form action="/login" method="post">
                <div class="mb-3">
                    <label class="form-label">Username/Email</label>
                    <input type="text" name="username" class="form-control">
                    <?php if ($this->session->has('errors')) { ?>
                        <?php foreach ($this->session->getFlash('errors') as $error) { ?>
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

                <button type="submit" class="btn btn-primary">Tizimga kirish</button>
            </form>
        </div>
    </div>
</div>

<?php $view->components('end') ?>