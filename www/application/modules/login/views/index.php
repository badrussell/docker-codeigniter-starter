<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="<?php echo base_url('assets/loginstyle/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/loginstyle/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/loginstyle/css/form-elements.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/loginstyle/css/style.css') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">

        body {
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

    </style>
</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <h3>Área do usuário</h3>

                            <?php if ($this->session->flashdata('error')): ?>
                                <div style="background-color: red !important;">
                                    <p> <strong><?php echo $this->session->flashdata('error')?></strong></p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">

                        <form role="form" action="<?php echo base_url('login') ?>" method="post" class="loginstyle-form">
                            <div class="form-group">
                                <label class="sr-only" for="form-username">E-mail</label>
                                <input type="text" name="email" id="email" placeholder="E-mail" class="form-username form-control" value="<?php echo set_value('email')?>" id="form-username">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="form-password">Senha</label>
                                <input type="password" name="senha" id="senha" placeholder="Senha" class="form-password form-control" id="form-password">
                            </div>
                            <button type="submit" class="btn">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="<?php echo base_url('assets/loginstyle/js/jquery-1.11.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/loginstyle/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/loginstyle/js/jquery.backstretch.min.js') ?>"></script>
<script src="<?php echo base_url('assets/loginstyle/js/scripts.js') ?>"></script>

<script language="JavaScript">
    var randnum = Math.random();
    var inum = 7;
    var rand1 = Math.round(randnum * (inum - 1)) + 1;
    images = new Array
    images[1] = "http://vertigocv.com.br/background/1.jpg"
    images[2] = "http://vertigocv.com.br/background/2.jpg"
    images[3] = "http://vertigocv.com.br/background/3.jpg"
    images[4] = "http://vertigocv.com.br/background/4.jpg"
    images[5] = "http://vertigocv.com.br/background/5.jpg"
    images[6] = "http://vertigocv.com.br/background/6.jpg"
    images[7] = "http://vertigocv.com.br/background/7.jpg"
    var image = images[rand1]

    document.write("<style>");
    document.write("body {");
    document.write(' background-image:url("' + image + '");');
    document.write(" }");
    document.write("</style>");

</script>

</body>

</html>