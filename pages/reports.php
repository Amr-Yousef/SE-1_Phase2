<?php
require_once '../classes/DBController.php';
require_once '../classes/Cardholder.php';
require_once '../classes/CreditCard.php';
require_once '../classes/Person.php';
require_once '../classes/AuthController.php';
require_once '../classes/Transaction.php';
require_once '../classes/reports-OOP.php';
session_start();

if (!isset($_SESSION["userOBJ"])) {
    header("location:sign-in.php");
} else {
    // echo $_SESSION['userOBJ']->getFirstName();
    $user = $_SESSION["userOBJ"];

?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <title>
            Soft UI Dashboard by Creative Tim
        </title>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- Nucleo Icons -->
        <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="../assets/css/soft-ui-dashboard-rtl.css?v=1.0.6" rel="stylesheet" />
    </head>

    <body class="g-sidenav-show  bg-gray-100">
        <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
            <div class="sidenav-header">
                <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
                    <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold">Soft UI Dashboard</span>
                </a>
            </div>
            <hr class="horizontal dark mt-0">
            <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link  active" href="reports.php">
                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g id="office" transform="translate(153.000000, 2.000000)">
                                                    <path class="color-background opacity-6" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                    </path>
                                                    <path class="color-background" d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">البلاغات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign-up_requests.php">
                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g id="office" transform="translate(153.000000, 2.000000)">
                                                    <path class="color-background opacity-6" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                    </path>
                                                    <path class="color-background" d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">طلبات حسابات جديد</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">أخرى</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " href="logout.php">
                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="12px" height="20px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>spaceship</title>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(1716.000000, 291.000000)">
                                                <g transform="translate(4.000000, 301.000000)">
                                                    <path class="color-background" d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z">
                                                    </path>
                                                    <path class="color-background opacity-6" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z">
                                                    </path>
                                                    <path class="color-background opacity-6" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z">
                                                    </path>
                                                    <path class="color-background opacity-6" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <span class="nav-link-text ms-1">تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">الصفحات</a></li>
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">البلاغات</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">البلاغات</h6>
                    </nav>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <form method="post">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="ابحث هنا...">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>آخر البلاغات</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    الحساب</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    السبب</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    الحالة</th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    تاريخ البلاغ</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['search'])) {
                                                $filtervalues = $_POST['search'];
                                                $query = "SELECT * FROM report WHERE CONCAT(CCN) LIKE '%$filtervalues%' ";
                                                include 'conn.php';
                                                $query_run = mysqli_query($conn, $query);

                                                if (mysqli_num_rows($query_run) > 0) {
                                                    foreach ($query_run as $items) {
                                            ?>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex px-2 py-1">
                                                                    <div>
                                                                        <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                                    </div>
                                                                    <div class="d-flex flex-column justify-content-center">
                                                                        <h6 class="mb-0 text-sm"><?= $items['Name'] ?></h6>
                                                                        <p class="text-xs text-secondary mb-0">
                                                                            <?= $items['CCN'][15] . $items['CCN'][14] . $items['CCN'][13] . $items['CCN'][12] ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p class="text-xs font-weight-bold mb-0"><?= $items['reason'] ?></p>
                                                                <p class="text-xs text-secondary mb-0">معدل إنحراف عالي</p>
                                                            </td>
                                                            <td class="align-middle text-center text-sm">
                                                                <?php
                                                                if ($items['status']) {
                                                                    echo '<span class="badge badge-sm bg-gradient-success">تمت</span>';
                                                                } else {
                                                                    echo '<span class="badge badge-sm bg-gradient-danger">لم تتم</span>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="text-secondary text-xs font-weight-bold"><?= $items['date'] ?></span>
                                                            </td>
                                                            <td class="align-middle">
                                                                <form method="post">
                                                                    <button class="text-secondary font-weight-bold text-xs" style="border: none;background: none;text-decoration: underline;text-underline-offset: 0.3rem;text-decoration-thickness: 0.1rem;" data-toggle="tooltip" data-original-title="Edit user" type="submit" name="<?= $items['ID'] . "edit" ?>">
                                                                        تم التعامل
                                                                    </button>
                                                                    <button class="text-secondary font-weight-bold text-xs" style="border: none;background: none;text-decoration: underline;text-underline-offset: 0.3rem;text-decoration-thickness: 0.1rem;" data-toggle="tooltip" data-original-title="Edit user" type="submit" name="<?= $items['ID'] . "delete" ?>">
                                                                        حذف
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo '<tr><td colspan="5" class="text-center">لا يوجد بيانات</td></tr>';
                                                }
                                            } else {
                                                ?>

                                        </tbody>
                                        <tbody>
                                            <?php
                                                $reps = report::getAllReports();
                                                foreach ($reps as $rep) {
                                                    if (isset($_POST[$rep->getID() . "edit"])) {
                                                        include('conn.php');
                                                        $query = mysqli_query($conn, "SELECT status FROM report WHERE ID = '" . $rep->getID() . "'");
                                                        $row = mysqli_fetch_assoc($query);
                                                        if ($row['status'] == 0 ) {
                                                            $auth = new AuthController;
                                                            $auth->updateStatus($rep->getID());
                                                            // sleep(1);
                                                            echo "<script>alert('The report is handeled successfully. PLEASE REFRESH THE PAGE WE DO NOT KNOW HOW TO REFRESH IT!!!!!!');</script>";
                                                            break;
                                                        } else {
                                                            echo "<script>alert('The report is already handeled');</script>";
                                                            break;
                                                        }
                                                    }
                                                    else if(isset($_POST[$rep->getID() . "delete"])){
                                                        include('conn.php');
                                                        $query = mysqli_query($conn, "DELETE FROM report WHERE ID = '" . $rep->getID() . "'");
                                                        
                                                        break;
                                                    }
                                                }
                                                foreach ($reps as $rep) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div>
                                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm"><?= $rep->getName() ?></h6>
                                                                <p class="text-xs text-secondary mb-0">
                                                                    <?= $rep->CCN[15] . $rep->CCN[14] . $rep->CCN[13] . $rep->CCN[12] ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0"><?= $rep->getReason() ?></p>
                                                        <p class="text-xs text-secondary mb-0">معدل إنحراف عالي</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <?php
                                                        if ($rep->getStatus()) {
                                                            echo '<span class="badge badge-sm bg-gradient-success">تمت</span>';
                                                        } else {
                                                            echo '<span class="badge badge-sm bg-gradient-danger">لم تتم</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span class="text-secondary text-xs font-weight-bold"><?= $rep->getDate() ?></span>
                                                    </td>
                                                    <td class="align-middle">
                                                        <form method="post">
                                                            <button class="text-secondary font-weight-bold text-xs" style="border: none;background: none;text-decoration: underline;text-underline-offset: 0.3rem;text-decoration-thickness: 0.1rem;" data-toggle="tooltip" data-original-title="Edit user" type="submit" name="<?= $rep->getID()."edit" ?>">
                                                                تم التعامل
                                                            </button>
                                                            <button class="text-secondary font-weight-bold text-xs" 
                                                            style="border: none;background: none;text-decoration: underline;text-underline-offset: 0.3rem;text-decoration-thickness: 0.1rem;" 
                                                            data-toggle="tooltip" data-original-title="Edit user" type="submit" name="<?= $rep->getID() . "delete" ?>">
                                                                حذف
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                        <?php
                                                }
                                            }

                                        ?>


                                        <!-- <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">الإسم الثنائي</h6>
                            <p class="text-xs text-secondary mb-0">آخر أربعة أرقام من البطاقة</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">آلي</p>
                        <p class="text-xs text-secondary mb-0">معدل إنحراف عالي</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">تمت</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">dd/mm/yy</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          تعديل
                        </a>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          حذف
                        </a>
                      </td>
                    </tr> -->


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer pt-3  ">
                    <div class="container-fluid">
                        <div class="row align-items-center justify-content-lg-between">
                            <div class="col-lg-6 mb-lg-0 mb-4">
                                <div class="copyright text-center text-sm text-muted text-lg-start">
                                    © <script>
                                        document.write(new Date().getFullYear())
                                    </script>,
                                    صمم بحب <i class="fa fa-heart"></i>
                                    <a href="#" class="font-weight-bold" target="_blank">فريق رقم 79</a>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link text-muted" target="_blank">شركتنا</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#/presentation" class="nav-link text-muted" target="_blank">من نحن ؟</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#/blog" class="nav-link text-muted" target="_blank">فريقنا</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </main>
        <!--   Core JS Files   -->
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
    </body>

    </html>
<?php  } ?>