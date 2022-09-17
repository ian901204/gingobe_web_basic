<!doctype html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="description" content="A growing collection of ready to use components for the CSS framework Bootstrap 5">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon.png">
    <meta name="author" content="Holger Koenemann">
    <meta name="generator" content="Eleventy v2.0.0">
    <meta name="HandheldFriendly" content="true">
    <title>金勾杯股份有限公司</title>
    <link rel="stylesheet" href="css/theme.min.css">
    <style>
        /* inter-200 - latin */
        @font-face {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 200;
        font-display: swap;
        src: local(''),
            url('../fonts/inter-v11-latin-200.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
            url('../fonts/inter-v11-latin-200.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
        }
        /* inter-300 - latin */
        @font-face {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 300;
        font-display: swap;
        src: local(''),
            url('../fonts/inter-v11-latin-300.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
            url('../fonts/inter-v11-latin-300.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
        }
        /* inter-regular - latin */
        @font-face {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: local(''),
            url('../fonts/inter-v11-latin-regular.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
            url('../fonts/inter-v11-latin-regular.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
        }
        /* inter-500 - latin */
        @font-face {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 500;
        font-display: swap;
        src: local(''),
            url('../fonts/inter-v11-latin-500.woff2') format('woff2'), /* Chrome 26+, Opera 23+, Firefox 39+ */
            url('../fonts/inter-v11-latin-500.woff') format('woff'); /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
        }

    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navScroll">
<?php
    include "menu.php";
?>

<main>
<div class="container py-vh-4 w-100 overflow-hidden">
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-lg-5">
        <h3 class="py-5 border-top border-dark" data-aos="fade-right">與傳統環保塑膠杯差異</h3>
    </div>
    <div class="col-md-7" data-aos="fade-left">
    <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Bordered Table</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        <!--<img src="img/person11.jpg" width="64" height="64" class="img-fluid rounded-circle me-3" alt="" data-aos="fade">
        <span><span class="fw-bold">John Doe,</span>
        CEO of Stride Ltd.</span>-->
    </div>
  </div>
</div>
    </main>

    <footer>
  <div class="container small border-top">
    <div class="row py-5 d-flex justify-content-between">

<div class="col-12 text-center">
  <?php
    include "footer.php";
  ?>
</div>

</div>
</div>
</footer>

    <script src="js/bootstrap.bundle.min.js"></script>
<script src="js/aos.js"></script>
 <script>
 AOS.init({
   duration: 800, // values from 0 to 3000, with step 50ms
 });
 </script>

 <script>
  let scrollpos = window.scrollY
  const header = document.querySelector(".navbar")
  const header_height = header.offsetHeight

  const add_class_on_scroll = () => header.classList.add("scrolled", "shadow-sm")
  const remove_class_on_scroll = () => header.classList.remove("scrolled", "shadow-sm")

  window.addEventListener('scroll', function() {
    scrollpos = window.scrollY;

    if (scrollpos >= header_height) { add_class_on_scroll() }
    else { remove_class_on_scroll() }

    console.log(scrollpos)
  })
</script>

  </body>
</html>
