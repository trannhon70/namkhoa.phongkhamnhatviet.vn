<?php
ob_start();
session_start();
include 'lib/session.php';
Session::init();

include_once 'classes/khoa.php';
include_once 'classes/benh.php';
include_once 'classes/bai_viet.php';
include_once 'classes/tin_tuc.php';

spl_autoload_register(function ($className) {
    include_once "classes/" . $className . ".php";
});

$khoas = new Khoa();
$post = new post();
$benh = new Benh();
$tin_tuc = new news();

$getAllChiTietKhoaAndBenh = $khoas->getAllChiTietKhoaAndBenh();
$getMenuMobile = $benh->getMenuMobile();
// var_dump($getMenuMobile);
?>


<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");

$local = 'http://localhost/_nhatvietnew/namkhoa.phongkhamnhatviet.vn';
// $local = 'https://namkhoa.phongkhamnhatviet.vn'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?php echo $local ?>/images/icons/icon_logo.png" type="image/x-icon">
    <link rel="preload" href="<?php echo $local ?>/css/index.min.css" as="style"
        onload='this.onload=null,this.rel="stylesheet"'>

    <noscript>

        <link rel="stylesheet" href="<?php echo $local ?>/css/index.min.css">
        <link rel="stylesheet" href="<?php echo $local ?>/css/toastr.min.css">
    </noscript>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function updateHeaderStylesheet() {
                // Xóa các stylesheet cũ nếu có
                const existingMobile = document.querySelectorAll('link[id^="mobile-"]');
                const existingDesktop = document.querySelectorAll('link[id^="desktop-"]');
                existingMobile.forEach(mobile => mobile.remove());
                existingDesktop.forEach(desktop => desktop.remove());

                // Thêm stylesheet mới dựa trên kích thước cửa sổ
                if (window.innerWidth < 1000) {
                    const mobileLink = [{
                            href: '<?php echo $local ?>/css/header-mobile.min.css',
                            id: 'mobile-0'
                        },
                        {
                            href: '<?php echo $local ?>/css/appointment-mobile.min.css',
                            id: 'mobile-1'
                        },
                        {
                            href: '<?php echo $local ?>/css/footer-mobile.min.css',
                            id: 'mobile-2'
                        },

                    ];
                    mobileLink.forEach(({
                        href,
                        id
                    }) => {
                        const link = document.createElement('link');
                        link.rel = 'stylesheet';
                        link.href = href;
                        link.id = id;
                        document.head.appendChild(link);
                    });

                } else {
                    const desktopLink = [{
                            href: '<?php echo $local ?>/css/header.min.css',
                            id: 'desktop-0'
                        },
                        {
                            href: '<?php echo $local ?>/css/footer.min.css',
                            id: 'desktop-1'
                        },
                        // {
                        //     href: 'css/footerPC.min.css',
                        //     id: 'desktop-2'
                        // },

                    ];
                    desktopLink.forEach(({
                        href,
                        id
                    }) => {
                        const link = document.createElement('link');
                        link.rel = 'stylesheet';
                        link.href = href;
                        link.id = id;
                        document.head.appendChild(link);
                    });
                }
            }

            updateHeaderStylesheet();
            window.addEventListener('resize', () => {
                console.log('Window resized to:', window.innerWidth);
                updateHeaderStylesheet();

            });
        });
    </script>
    <script>
        // Chỉ tải Google Analytics khi người dùng cuộn xuống
        document.addEventListener('scroll', function loadGA() {
            console.log('Người dùng cuộn xuống - Tải Google Analytics');

            // Tạo thẻ script
            var g = document.createElement('script'),
                s = document.scripts[0];
            g.src = 'https://www.googletagmanager.com/gtag/js?id=G-EYBBJF6GYP';
            g.async = true;
            s.parentNode.insertBefore(g, s);

            // Cấu hình gtag
            g.onload = function() {
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', 'G-EYBBJF6GYP');
            };

            // Xóa sự kiện lắng nghe để không tải lại
            document.removeEventListener('scroll', loadGA);
        });
    </script>

    <!-- Google Tag Manager -->

    <script>
        function loadGTM() {
            if (window.gtmLoaded) return;
            window.gtmLoaded = true;

            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-5QD9GPKH');
        }

        window.addEventListener('scroll', loadGTM, {
            once: true
        });
        window.addEventListener('mousemove', loadGTM, {
            once: true
        });
        window.addEventListener('touchstart', loadGTM, {
            once: true
        });
    </script>
    <!-- End Google Tag Manager -->