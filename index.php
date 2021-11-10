<?php
    include "inc/header.php";
?>

    <div class="container">
        <main role="main" class="pb-3">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card login-logout-tab">
                        <div class="card-header">
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Login</a>
                                </li> 
                            </ul>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-10 offset-md-1">
                                        <section>
                                            <div class="login-form-icon">
                                                <i class="fas fa-user-circle fa-9x text-secondary"></i>
                                            </div>
                                            <form method="post" action="">
                                                <div>
                                                    <span id="response"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input id="username" class="form-control" name="username" />
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input id="password" class="form-control" name="password" />
                                                    <span class="text-danger"></span>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" id="btn-login" class="btn btn-primary btn-block">Submit</button>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<?php
    include "inc/footer.php";
?>