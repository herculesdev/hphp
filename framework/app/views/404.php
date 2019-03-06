<?php
/**
 * User: Hércules
 * Date: 20/01/2019
 * Time: 15:05
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>404 - Page Not Found</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>

    <body>
    <style>
        #main {
            height: 90vh;
        }
    </style>
        <div class="d-flex justify-content-center align-items-center" id="main">
            <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">404</h1>
            <div class="inline-block align-middle">
                <h2 class="font-weight-normal lead" id="desc">A página que você requisitou não foi encontrada.</h2>
                <a href="<?php echo base_url(); ?>">← Início</a>                
            </div>
        </div>
    </body>
</html>
