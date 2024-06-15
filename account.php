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
    <title>EDUTECH | account</title>
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <style>
        nav {
            padding: 3rem;

        }

        .notifications small {
            align-self: flex-end;
            margin-top: 1rem;
            color: gray;
            font-weight: bold;
            font-size: 9px;
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

            .messages .content {
                height: 90vh;
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
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <p>Notifications</p>
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
                            <?php if (isset($_SESSION['pay-success'])): ?>

                                <div class="alert__message success">
                                    <p>
                                        <?= $_SESSION['pay-success'];
                                        unset($_SESSION['pay-success']);
                                        ?>
                                    </p>
                                </div>
                            <?php elseif (isset($_SESSION['pay'])): ?>
                                <div class="alert__message error">
                                    <p>
                                        <?= $_SESSION['pay'];
                                        unset($_SESSION['pay']);
                                        ?>
                                    </p>
                                </div>
                            <?php endif ?>
                            <h4>Mpesa</h4>
                            <p>Ksh. 3,000</p>
                            <form action="<?= ROOT_URL ?>pay.php" method="POST">
                                <input type="number" name="amount" value="3000" placeholder="Enter Amount To pay">
                                <button type="submit" class="btn" name="submit">Pay</button>
                            </form>
                        </div>
                    <?php elseif ($user_record['plan'] == 1): ?>
                        <h3 style="color: #6a5acd;">Premimum Plan</h3>
                        <?php if (isset($_SESSION['pay-success'])): ?>

                            <div class="alert__message success">
                                <p>
                                    <?= $_SESSION['pay-success'];
                                    unset($_SESSION['pay-success']);
                                    ?>
                                </p>
                            </div>
                        <?php elseif (isset($_SESSION['pay'])): ?>
                            <div class="alert__message error">
                                <p>
                                    <?= $_SESSION['pay'];
                                    unset($_SESSION['pay']);
                                    ?>
                                </p>
                            </div>
                        <?php endif ?>
                        <div class="plan">
                            <h4>Mpesa</h4>
                            <p>Ksh. 3,000</p>
                            <h3>Paid</h3>
                        </div>
                    <?php endif; ?>
                </div>
                <div id="main" class="main">
                    <h3 style="color: slateblue; margin-bottom: 2rem;">Notifications</h3>
                    <?php if (isset($_SESSION['message-success'])): ?>

                        <div class="alert__message success">
                            <p>

                                <?= $_SESSION['message-success'];
                                unset($_SESSION['message-success']);
                                ?>
                            </p>
                        </div>
                    <?php elseif (isset($_SESSION['message'])): ?>
                        <div class="alert__message error">
                            <p>
                                <?= $_SESSION['message'];
                                unset($_SESSION['message']);
                                ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <div class="notifications">
                        <?php
                        // Fetch user data from the database
                        $fetch_user_query = "SELECT * FROM notifications WHERE user_id = $id";
                        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

                        // Convert the record into an associative array
                        while ($user_record = mysqli_fetch_assoc($fetch_user_result)):

                            ?>

                            <div class="notification">
                                <span><?php echo $user_record['reply'] ?></span>
                                <small><?php echo $user_record['reply_time'] ?></small>
                            </div>
                            <div class="notification send">
                                <span><?php echo $user_record['message_text'] ?></span>
                                <small><?php echo $user_record['message_time'] ?></small>
                            </div>

                        <?php endwhile; ?>
                    </div>
                    <div class="content">
                        <form id="message-form" action="<?php ROOT_URL ?> save-message.php" method="POST">
                            <textarea id="message" name="message" placeholder="Contact admin" required></textarea>
                            <button type="submit" class="btn" name="">Send<i class="fa fa-share"
                                    aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
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

            // Function to show a section by index
            const showSection = (index) => {
                removeActiveClass();
                asideSpans[index].classList.add('active-aside__span');
                mainSections.forEach((section, i) => {
                    section.style.display = i === index ? 'block' : 'none';
                });
            };

            asideSpans.forEach((span, index) => {
                span.addEventListener('click', () => {
                    showSection(index);
                    // Save the active section index to localStorage
                    localStorage.setItem('activeSectionIndex', index);
                });
            });

            viewOrderLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const orderDetailsIndex = mainSections.length - 1; // Assuming order details is the last section
                    showSection(orderDetailsIndex);
                    // Save the active section index to localStorage
                    localStorage.setItem('activeSectionIndex', orderDetailsIndex);
                });
            });

            // Get the saved active section index from localStorage, or default to 0
            const savedSectionIndex = localStorage.getItem('activeSectionIndex');
            const defaultSectionIndex = savedSectionIndex !== null ? parseInt(savedSectionIndex, 10) : 0;

            // Show the saved or default section
            showSection(defaultSectionIndex);
        });

    </script>
</body>

</html>