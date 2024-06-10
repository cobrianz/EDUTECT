<?php
require 'config/database.php';
if (!isset($_SESSION['user-id'])) {
    header('Location:' . ROOT_URL . 'login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eduka</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <style>
        nav {
            padding: 3rem;

        }

        @media only screen and (max-width: 800px) {
            .account__hero {
                background: #d5e0ee;
            }

            nav {
                padding: 0;
            }

            .nav_details {
                display: none;
            }
        }
    </style>
</head>

<body style="background: #d5e0ee;">
    <nav>
        <div class="navbar">
            <div class="logo">
                <a href="index.php">
                    <img src="./assets/logo.png" alt="">
                </a>
            </div>
            <div class="nav__right"
                style="border: none; display: flex; align-items: center; gap: 1rem; justify-content: center;">
                <?php
                if (isset($_SESSION['user-id'])):
                    $id = $_SESSION['user-id'];
                    $fetch_user_query = "SELECT * FROM users WHERE id = '$id'";
                    $run_query = mysqli_query($connection, $fetch_user_query);
                    $user_record = mysqli_fetch_assoc($run_query);

                    ?>

                    <img src="profiles/<?php echo $user_record['avatar'] ?> " class="profile_image" alt="">

                </div>
            </div>
        </nav>

        <div class="account__hero container">
            <aside>
                <h3>Personal Profile</h3>
                <div class="account__user">

                    <img src="profiles/<?php echo $user_record['avatar'] ?>" alt="">
                    <span>
                        <h4><?php echo $user_record['name'] ?> </h4>
                        <p><i><?php echo $user_record['email'] ?></i></p>
                    </span>
                </div>
                <span class="aside__span">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    <p>Personal Information</p>
                </span>
                <span class="aside__span">
                    <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                    <p>Upgrade</p>
                </span>
                <span class="aside__span">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <p style="text-decoration: line-through;">Courses</p>
                </span>
                <span class="aside__span">
                    <a href="./index.php"><i class="fa fa-sign-out" aria-hidden="true" style="color: red;"></i>
                    </a>
                    <p><a href="./logout.php" style="color: #c27272;">Logout</a></p>
                </span>
            </aside>

            <main>
                <div id="main" class="main Personal__information">
                    <div class="signup__form-container">
                        <div class="form">
                            <h3>Personal Information</h3>
                            <form action="#" method="POST">
                                <label for="email">Email Address *</label>
                                <input type="email" value="" placeholder="<?php echo $user_record['email'] ?>">
                                <label for="name">Name *</label>
                                <input type="text" value="" placeholder="<?php echo $user_record['name'] ?>">
                                <p class="update">update you password details below.</p>
                                <label id="passcode" class="passcode" for="password">Password *</label>
                                <input id="passcode" class="passcode" type="password" value="" placeholder="••••••••">
                                <button type="submit" class="btn" name="">Update Account</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="main" class="main plan__info">
                    <?php if ($user_record['plan'] == 0): ?>
                        <h3 style="color: #6a5acd;">Basic Plan</h3>
                        <div class="plan">
                            <h4>Mpesa</h4>
                            <p>Ksh. 3,000</p>
                            <form action="#">
                                <input type="number" placeholder="Enter Amount To pay">
                                <button type="submit" class="btn" name="">Pay</button>
                            </form>
                        </div>
                    <?php elseif ($user_record['plan'] == 1): ?>
                        <h3 style="color: #6a5acd;">Premimum Plan</h3>
                        <div class="plan">
                            <h4>Mpesa</h4>
                            <p>Ksh. 3,000</p>
                            <h3>Paid</h3>
                        </div>
                    <?php endif; ?>
                    </div>
            <?php endif; ?>

    </div>
    </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const asideSpans = document.querySelectorAll('.aside__span');
            const mainSections = document.querySelectorAll('.main');
            const viewOrderLinks = document.querySelectorAll('.my__orders a');
            const openMenu = document.querySelector('.fa-bars');
            const closeMenu = document.querySelector('.fa-times');
            const menu = document.querySelector('ul');


            // Function to remove 'active-aside__span' class from all spans
            const removeActiveClass = () => {
                asideSpans.forEach(s => s.classList.remove('active-aside__span'));
            };

            asideSpans.forEach((span, index) => {
                span.addEventListener('click', () => {
                    removeActiveClass();
                    span.classList.add('active-aside__span');
                    mainSections.forEach(section => section.style.display = 'none');
                    mainSections[index].style.display = 'block';
                });
            });

            viewOrderLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    removeActiveClass();
                    mainSections.forEach(section => section.style.display = 'none');
                    const orderDetailsIndex = mainSections.length - 1; // Assuming order details is the last section
                    mainSections[orderDetailsIndex].style.display = 'block';
                });
            });

            // Set default open section (Personal Information)
            const defaultSectionIndex = 0;
            asideSpans[defaultSectionIndex].classList.add('active-aside__span');
            mainSections.forEach((section, index) => {
                section.style.display = index === defaultSectionIndex ? 'block' : 'none';
            });


            openMenu.addEventListener('click', () => {
                menu.style.display = 'flex';
                openMenu.style.display = 'none';
                closeMenu.style.display = 'flex';

            });

            closeMenu.addEventListener('click', () => {
                menu.style.display = 'none';
                openMenu.style.display = 'flex';
                closeMenu.style.display = 'none';

            });

            //Shop aside javascript

            const asideToggler = document.querySelector('.aside__toggler');
            const aside = document.querySelector('.shop__aside');

            asideToggler.addEventListener('click', () => {
                aside.classList.toggle('shop__aside-active');
            });
            ;

        });
    </script>
</body>

</html>