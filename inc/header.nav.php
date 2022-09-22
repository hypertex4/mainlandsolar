<?php ob_start(); session_start(); ?>
<?php $filepath = realpath(dirname(__FILE__));
include_once($filepath."/../controllers/classes/GlobalApi.class.php"); define('CONTROLLER_ROOT_URL', 'http://localhost/mainlandsolar/controllers'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mainland Solar | Your No 1 choice for Solar Installations & Support</title>
    <base href="http://localhost/mainlandsolar/">
    <link rel="icon" type="image/png" class="img-fluid" href="./assets/images/navbrand-logo-min.png" sizes="16x16">
    <meta name="description" content="Your No 1 choice for Solar Installations & Support">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link href="./assets/plugins/aos@2.3.1/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/plugins/bxSlider/dist/js/jquery.bxslider.css">
    <link rel="stylesheet" href="./assets/plugins/bxSlider/dist/js/jquery.bxslider.min.css">
    <link rel="stylesheet" href="./assets/plugins/owlCarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="./assets/plugins/owlCarousel/owl.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/plugins/bootstrap@4.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/toastr.min.css">
    <link rel="stylesheet" href="./assets/css/jquery-confirm.min.css">
    <link rel="stylesheet" href="./assets/css/style.min.css" />
    <link rel="stylesheet" href="./assets/css/calendar.style.css" />
    <style>
        form .error {color: #e74c3c;border-color: #e74c3c !important;}
        form label.error{font-size: 0.7rem;}
        select {}
        a.call-act{color:#fff;background: #209E02;display: inline-flex; padding: 6px 15px; text-decoration: none;}
        a.call-act:hover{background: transparent; border: 1px solid #209E02;}
    </style>
</head>

<body>
<div id="loading">
    <div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>
</div>
<div id="top-header">
    <div class="inner container auto-wrapper d-flex align-items-center justify-content-between flex-wrap">
        <ul class="contact d-flex p-0 list-style-none my-0 flex-wrap">
            <li class="email d-flex align-items-center">
                <div class="mr-1">
                    <span><img src="./assets/images/icons/envelope-icon.svg" alt="email envelope icon" class="img-fluid icon-img"/></span>
                </div>
                <div>support@mainlandsolar.com</div>
            </li>
            <li class="phone d-flex align-items-center">
                <div class="mr-1">
                    <span><img src="./assets/images/icons/phone-icon.svg" alt="phone icon" class="img-fluid icon-img"/></span>
                    <span class="mx-1">|</span>
                    <span><img src="./assets/images/icons/whatsapp-icon.svg" alt="whatsapp icon" class="img-fluid icon-img"/></span>
                </div>
                <div>09042728266</div>
            </li>
        </ul>
        <div class="social-medial-icons">
            <ul class="list-style-none d-flex align-items-center my-0 p-0">
                <li>
                    <a href="#">
                        <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.4578 2.64914C17.7787 2.95062 17.0488 3.15365 16.2828 3.24517C17.065 2.77681 17.6656 2.03465 17.9479 1.15022C17.2165 1.58398 16.4059 1.8993 15.543 2.06926C14.8531 1.33326 13.8679 0.873352 12.7789 0.873352C10.334 0.873352 8.53748 3.15442 9.08967 5.5224C5.9434 5.36474 3.1532 3.85736 1.28512 1.56629C0.293017 3.26825 0.770611 5.49471 2.45642 6.62217C1.83655 6.60218 1.25205 6.43221 0.742155 6.14842C0.700625 7.90268 1.95806 9.54388 3.77922 9.90919C3.24626 10.0538 2.66253 10.0876 2.06881 9.97379C2.55025 11.4781 3.94842 12.5725 5.60654 12.6033C4.01456 13.8515 2.00882 14.409 0 14.1722C1.67581 15.2466 3.66694 15.8734 5.80496 15.8734C12.8358 15.8734 16.8081 9.93534 16.5681 4.60951C17.308 4.075 17.9502 3.40822 18.4578 2.64914V2.64914Z" fill="#F1F2F1"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.5 1.35188C9.5025 1.35188 9.74 1.35938 10.5313 1.39563C12.5638 1.48813 13.5131 2.4525 13.6056 4.47C13.6419 5.26062 13.6487 5.49813 13.6487 7.50063C13.6487 9.50375 13.6412 9.74063 13.6056 10.5313C13.5125 12.5469 12.5656 13.5131 10.5313 13.6056C9.74 13.6419 9.50375 13.6494 7.5 13.6494C5.4975 13.6494 5.26 13.6419 4.46938 13.6056C2.43188 13.5125 1.4875 12.5438 1.395 10.5306C1.35875 9.74 1.35125 9.50312 1.35125 7.5C1.35125 5.4975 1.35938 5.26063 1.395 4.46938C1.48813 2.4525 2.435 1.4875 4.46938 1.395C5.26063 1.35938 5.4975 1.35188 7.5 1.35188V1.35188ZM7.5 0C5.46312 0 5.20812 0.00875 4.40812 0.045C1.68438 0.17 0.170625 1.68125 0.045625 4.4075C0.00875 5.20813 0 5.46312 0 7.5C0 9.53688 0.00875 9.7925 0.045 10.5925C0.17 13.3162 1.68125 14.83 4.4075 14.955C5.20813 14.9912 5.46312 15 7.5 15C9.53688 15 9.7925 14.9912 10.5925 14.955C13.3138 14.83 14.8313 13.3187 14.9544 10.5925C14.9913 9.7925 15 9.53688 15 7.5C15 5.46312 14.9912 5.20812 14.955 4.40812C14.8325 1.68687 13.3194 0.170625 10.5931 0.045625C9.7925 0.00875 9.53688 0 7.5 0V0ZM7.5 3.64875C5.37312 3.64875 3.64875 5.37312 3.64875 7.5C3.64875 9.62688 5.37312 11.3519 7.5 11.3519C9.62688 11.3519 11.3513 9.6275 11.3513 7.5C11.3513 5.37312 9.62688 3.64875 7.5 3.64875ZM7.5 10C6.11937 10 5 8.88125 5 7.5C5 6.11937 6.11937 5 7.5 5C8.88063 5 10 6.11937 10 7.5C10 8.88125 8.88063 10 7.5 10ZM11.5038 2.59688C11.0063 2.59688 10.6031 3 10.6031 3.49687C10.6031 3.99375 11.0063 4.39687 11.5038 4.39687C12.0006 4.39687 12.4031 3.99375 12.4031 3.49687C12.4031 3 12.0006 2.59688 11.5038 2.59688Z" fill="#F1F2F1"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.875 5H0V7.5H1.875V15H5V7.5H7.27625L7.5 5H5V3.95813C5 3.36125 5.12 3.125 5.69687 3.125H7.5V0H5.12C2.8725 0 1.875 0.989375 1.875 2.88437V5Z" fill="#F1F2F1"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="./system-questionnaire-step-one/" class="call-act" data-aos="fade-up" data-aos-duration="1000">Estimate System Requirements</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- main header -->
<header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-light border-bottom" id="toolbar">
        <div class="container auto-wrapper inner">
            <a class="navbar-brand" href="./"><h2>Mainland Solar</h2></a>
            <div class="d-flex align-items-center">
                <div class="shopping-cart-wrapper" id="mobile-shopping-cart-counter">
                    <img src="./assets/images/icons/shopping-cart-icon.svg" alt="shopping-cart icon" class="img-fluid icon-img mr-2" />
                    <a href="./product/cart" class="dark-link">
                        <span class="mr-1">Cart</span>
                        <span class="cust-badge total-count">0</span>
                    </a>
                </div>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active item-dropdown drop-icon">
                        <a class="nav-link" href="javascript::void(0)">About Us <span class="sr-only">(current)</span></a>
                        <div class="item-dropdown-content">
                            <ul class="list-style-none p-3 shadow-sm">
                                <li class="py-2 list-item"><a href="./about-us">What we do</a></li>
                                <li class="py-2 list-item"><a href="./about-us#value-offered-section">Why choose us</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="./services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="./product/">Products</a></li>
                    <li class="nav-item item-dropdown drop-icon">
                        <a class="nav-link" href="javascript::void(0)">Support and self services</a>
                        <div class="item-dropdown-content">
                            <ul class="list-style-none p-3 shadow-sm">
                                <li class="py-2 list-item"><a href="./system-questionnaire-step-one">LOAD/SYSTEM QUESTIONNAIRE</a></li>
                                <li class="py-2 list-item"><a href="./history">PROJECT HISTORY</a></li>
                                <li class="py-2 list-item"><a href="./contact-us">CONTACT US</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resources">Resources</a>
                    </li>
                    <?php if (isset($_SESSION['USER_LOGIN']) && isset($_SESSION['USER_LOGIN']['customer_id'])) { ?>
                    <li class="nav-item item-dropdown">
                        <a class="nav-link"><span class="bold uppercase">
                            Hi <?= $_SESSION['USER_LOGIN']['firstname'];?></span>&nbsp;/&nbsp;<span>
                            <button class="btn btn-sm text-danger p-0">LOGOUT</button>
                        </a>
                        <div class="item-dropdown-content user-account-dropdown">
                            <ul class="list-style-none p-3 shadow-sm">
                                <li class="py-2 list-item"><a href="account/">ACCOUNT</a></li>
                                <li class="py-2 list-item"><a href="account/purchase-history">PURCHASE HISTORY</a></li>
                                <li class="py-2 list-item"><a href="account/wishlist">WISHLIST</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item user-auth-nav">
                        <div class="greet">Hi Guest</div>
                        <div>
                            <span><a href="./login" class="dark-link">Sign in</a></span>
                            <span>or</span>
                            <span><a href="./register" class="dark-link">Register</a></span>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
                <div class="horizon-separator"></div>
                <div class="align-item-end shopping-cart-wrapper" id="lg-shopping-cart-counter">
                    <img src="./assets/images/icons/shopping-cart-icon.svg" alt="shopping-cart icon" class="img-fluid icon-img mr-2" />
                    <a href="./product/cart" class="dark-link">
                        <span class="mr-1">Cart</span>
                        <span class="cust-badge total-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>