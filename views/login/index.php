<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form action="/login/login" method="post">
                <h1>Login Form</h1>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
<!--                    <a class="btn btn-default submit" href="index.html">Log in</a>-->
                    <button type="submit" class="btn btn-default submit">Log in</button>
                </div>
                <?php  if($params){ ?>
                <div class="alert alert-danger" role="alert">
                    <?= $params; ?>
                </div>
                <?php }?>
            </form>
        </section>
    </div>
</div>