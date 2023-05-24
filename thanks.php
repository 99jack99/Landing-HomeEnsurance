<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks!</title>

    <!-- PIXEL FB -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1602073256631158');
        fbq('track', 'PageView');
    </script>
</head>

<style>
    .background {
        height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    img {
        height: 150px;
        width: 300px;
    }

    .box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #29282A;
    }

    h2 {
        font-size: 60px;
    }

    h4 {
        margin-inline: 10%;
        font-size: 30px;
        font-weight: 450;
        text-align: center;
    }
</style>
<body>
    <?php
    include('server.php');

    if (!isset($_SESSION['pixelOK'])) {
        if (categoria($_SESSION['personalizado1'], 'NO;OTRA;')) {
            $data = array(
                'id_campanya' => 383,
                'tope' => 5
            );
            if (sendContador($data) == 1) {
                if ((isset($_SESSION['enviado_pixel']) && $_SESSION['enviado_pixel'] != true) || !isset($_SESSION['enviado_pixel'])) {
                    echo '<script src="https://startendmarketing.go2cloud.org/aff_lsr?offer_id=1&transaction_id=' . CONVERSION . '" scrolling="no" frameborder="0" width="1" height="1"></script>';
                    $_SESSION['enviado_pixel'] = true;
                }
            }
        }
        $_SESSION['pixelOK'] = 1;
        setPixel('https://hogar.calcular-seguros.com/');
    }
    ?>
    <div class="background">
        <img src="../assets/imgs/logo/catalana-occidente.png" alt="Catalana Occidente">
        <div class="box">
            <h2>Gracias!</h2>
            <h4>Tu registro se ha efectuado correctamente.En breves, un agente especializado contactara contigo para
                informarte del precio de tu seguro de hogar</h4>
        </div>
    </div>
</body>

</html>