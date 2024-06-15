<?php
require 'config/database.php';
if (!isset($_SESSION['admin-id'])) {
    header('Location:' . ROOT_URL . 'login.php');
    $_SESSION['login'] = "You must be logged in to access this page.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUTECH</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <a href="../index.php"><img src="../assets/logo.png" alt="" style="width: 100%;"></a>
                </div>

            </div>

            <div class="sidebar">
                <a href="#" id="dashboard-link">
                    <span><i class="fa fa-th-large" aria-hidden="true"></i></span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" id="students-link">
                    <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    <h3>Students</h3>
                </a>
                <a href="#" id="analytics-link">
                    <span><i class="fa fa-usd" aria-hidden="true"></i></span>
                    <h3>Transactions</h3>
                </a>

                <?php
                // Fetch count of unreplied messages
                $count_unreplied_query = "
SELECT COUNT(*) AS unreplied_count
FROM notifications
WHERE reply = '' OR reply IS NULL
";
                $count_unreplied_result = mysqli_query($connection, $count_unreplied_query);
                $count_unreplied_row = mysqli_fetch_assoc($count_unreplied_result);
                $unreplied_count = $count_unreplied_row['unreplied_count'];

                // Close the result set
                mysqli_free_result($count_unreplied_result);

                // Display the fetched data
                ?>
                <a href="#" id="messages-link">
                    <span><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
                    <h3>Messages</h3>
                    <span class="message-count"><?= $unreplied_count ?></span>
                </a>

                <a href="#" id="admins-link">
                    <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    <h3>Admins</h3>
                </a>
                <a href="#" id="settings-link">
                    <span><i class="fa fa-cogs" aria-hidden="true"></i></span>
                    <h3>Settings</h3>
                </a>
                <a href="<?php echo ROOT_URL ?>logout.php"
                    style="background: #eeb7b7; width: fit-content; padding: 1rem; border-radius: 5px; color: #363030;">
                    <span><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <!-- main -->
        <main class="content-container">
            <div id="dashboard-content" class="content-section">
                <h1>Dashboard</h1>
                <div class="date" style="width: fit-content;">
                    <input type="date">
                </div>

                <div class="insights">
                    <?php
                    // Calculate the date seven days ago
                    $sevenDaysAgo = date('Y-m-d', strtotime('-7 days'));

                    // SQL query to fetch rows within the last seven days
                    $sql = "SELECT * FROM finances WHERE DATE(date) >= '$sevenDaysAgo'";

                    $result = $connection->query($sql);

                    $newIncome = $result->num_rows;

                    $query = "SELECT COUNT(*) AS row_count FROM finances";
                    $result = mysqli_query($connection, $query);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $rowCount = $row['row_count'];
                    }
                    ?>
                    <!-- end of sales -->
                    <div class="expenses">
                        <span>
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </span>
                        <div class="middle">
                            <div class="left">
                                <h3>New Income</h3>
                                <h1>Ksh. <?php
                                echo 3000 * $newIncome;

                                ?></h1>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="number">
                                    <p>62%</p>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">Last 7 days</small>
                    </div>
                    <!-- end of Expenses -->
                    <div class="income">
                        <span>
                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                        </span>
                        <div class="middle">
                            <div class="left">
                                <h3>Total income</h3>
                                <h1>Ksh. <?php
                                echo 3000 * $rowCount;

                                ?></h1>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="number">
                                    <p>44%</p>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">Since June 14th 2024</small>
                    </div>
                    <!-- end of income -->
                    <div class="sales">
                        <span>
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </span>
                        <div class="middle">
                            <div class="left">
                                <h3>Cancelled Membership</h3>
                                <h1>Ksh. 21,000</h1>
                            </div>
                            <div class="progress">
                                <svg>
                                    <circle cx="38" cy="38" r="36"></circle>
                                </svg>
                                <div class="number">
                                    <p>4%</p>
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">Last 24 hours</small>
                    </div>
                </div>
                <!-- end of insights -->
                <div class="recent-orders">
                    <h2>Analytics</h2>
                    <div class="charts">
                        <div class="chart">

                            <canvas id="myChart1"></canvas>
                        </div>
                        <div class="chart"
                            style="width: 600px; height: 400px; display: flex; align-items: center; justify-content: center;">
                            <canvas id="myChart"></canvas>

                        </div>
                    </div>
                </div>
            </div>
            <div id="students-content" class="content-section" style="display: none;">
                <h2>All Students</h2>

                <div class="admins">
                    <?php
                    // Fetch user data from the database
                    $fetch_user_query = "SELECT * FROM users";
                    $fetch_user_result = mysqli_query($connection, $fetch_user_query);

                    // Convert the record into an associative array
                    while ($user_record = mysqli_fetch_assoc($fetch_user_result)):

                        ?>


                        <div class="admin" onclick="ShowAdmin()">
                            <img src="../profiles/<?= $user_record['avatar'] ?>" alt="">
                            <span><?= $user_record['name'] ?></span>
                            <div class="admin_details" id="admin_details">

                                <span>Email: <strong>braisonwabwire@gmmail.com</strong></span>
                                <?php if ($user_record['plan'] == 0): ?>
                                    <span>Plan: <strong>Basic</strong></span>
                                <?php elseif ($user_record['plan'] == 1): ?>
                                    <span>Plan: <strong style="color: slateblue;">Premium</strong></span>
                                <?php endif; ?>
                                <span>ID: <strong><?= $user_record['id'] ?></strong></span>
                                <span>Date: <strong>20-12-2024</strong></span>

                                <div class="admin_buttons">
                                    <span>Edit</span>
                                    <span>Delete</span>
                                </div>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

            </div>
            <div id="analytics-content" class="content-section" style="display: none;">
                <div class="recent-orders">
                    <h2>Financial Transactions</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Email</th>
                                <th>Date</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // Fetch user data from the database
                            $fetch_finance_query = "SELECT * FROM finances";
                            $fetch_finance_result = mysqli_query($connection, $fetch_finance_query);

                            // Convert the record into an associative array
                            while ($finance_record = mysqli_fetch_assoc($fetch_finance_result)):

                                ?>
                                <tr>
                                    <td><?= $finance_record['id'] ?></td>
                                    <td><?= $finance_record['userId'] ?></td>
                                    <td><?= $finance_record['email'] ?></td>
                                    <td><?= $finance_record['date'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                            <?php
                            $query = "SELECT COUNT(*) AS row_count FROM finances";
                            $result = mysqli_query($connection, $query);
                            if ($result):
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                    $row = mysqli_fetch_assoc($result);
                                    $rowCount = $row['row_count'];
                                    ?>
                                    <td style="font-size: 1.2rem;color: black; text-align: center; font-weight: bold;">
                                        Total = Ksh. <?= $rowCount * 3000 ?></td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div id="messages-content" class="content-section" style="display: none;">
                <div class="recent-orders">
                    <?php if (isset($_SESSION['reply-success'])): ?>

                        <div class="alert__message success">
                            <p>
                                <?= $_SESSION['reply-success'];
                                unset($_SESSION['reply-success']);
                                ?>
                            </p>
                        </div>
                    <?php elseif (isset($_SESSION['reply'])): ?>
                        <div class="alert__message error">
                            <p>
                                <?= $_SESSION['reply'];
                                unset($_SESSION['reply']);
                                ?>
                            </p>
                        </div>
                    <?php endif ?>
                    <h2>Notifications</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User Id</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Reply</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fetch_user_query = "
                           SELECT *
                           FROM notifications
                           ORDER BY 
                               CASE WHEN reply = '' OR reply IS NULL THEN 0 ELSE 1 END, -- unreplied first
                               user_id, -- then sort by user_id
                               message_time DESC -- latest message first within the same user_id
                       ";
                            $fetch_user_result = mysqli_query($connection, $fetch_user_query);

                            // Convert the record into an associative array
                            while ($user_record = mysqli_fetch_assoc($fetch_user_result)):
                                ?>
                                <tr>
                                    <td><?= $user_record['id'] ?></td>
                                    <td><?= $user_record['user_id'] ?></td>
                                    <td><img src="../profiles/<?= $user_record['avatar'] ?>" alt=""></td>
                                    <td><?= $user_record['author'] ?></td>
                                    <td class="message_text"><?= $user_record['message_text'] ?></td>
                                    <td><?= $user_record['message_time'] ?></td>
                                    <td class="message_text"><?= $user_record['reply'] ?></td>
                                    <?php if ($user_record['reply']): ?>
                                        <td><i class="fa fa-check" aria-hidden="true" style="color: #6a5acd;"></i></td>
                                    <?php else: ?>
                                        <td><i class="fa fa-bell" aria-hidden="true" style="color: red;"></i></td>
                                    <?php endif; ?>
                                    <td><button class="admin-btn" onclick="pop(<?= $user_record['id'] ?>)">Reply</button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div id="message-form" class="chat hidden">
                    <i class="fa fa-times message_close" aria-hidden="true" onclick="pop()"></i>
                    <h3>Chat with Braison Wabwire</h3>
                    <div class="notifications">
                        <?php
                        // Fetch user data from the database
                        $fetch_user_query = "SELECT * FROM notifications WHERE user_id = 1";
                        $fetch_user_result = mysqli_query($connection, $fetch_user_query);

                        // Convert the record into an associative array
                        while ($user_record = mysqli_fetch_assoc($fetch_user_result)):

                            ?>

                            <div class="notification">
                                <span><?php echo $user_record['reply'] ?>lorem600</span>
                                <small><?php echo $user_record['reply_time'] ?></small>
                            </div>
                            <div class="notification send">
                                <span><?php echo $user_record['message_text'] ?></span>
                                <small><?php echo $user_record['message_time'] ?></small>
                            </div>

                        <?php endwhile; ?>
                    </div>
                    <div class="content">
                        <form action="<?php ROOT_URL ?>reply.php" method="POST">
                            <input type="hidden" id="user_id" name="user_id" value="">
                            <textarea id="message" name="message" placeholder="Reply" required></textarea>
                            <button type="submit" class="btn admin-btn" name="submit">Reply
                                <i class="fa fa-share" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>






            </div>
            <div id="admins-content" class="content-section" style="display: none;">
                <div class="admin_header">
                    <h2>Administrators </h2>
                    <span onclick="addAdmin()">Register Admin</span>
                </div>
                <div class="admins">

                    <div class="admin" onclick="ShowAdmin()">
                        <img src="../profiles/1717929686avatar3.jpg" alt="">
                        <span>Braison Wabwire</span>
                        <div class="admin_details" id="admin_details">
                            <span>Name: <strong>Braison Wabwire</strong></span>
                            <span>Email: <strong>braisonwabwire@gmmail.com</strong></span>
                            <span>National ID: <strong>11464579</strong></span>
                            <span>Phone: <strong>+254702764907</strong></span>
                            <span>Salary: <strong>Ksh. 200000</strong></span>
                            <span>Date: <strong>20-12-2024</strong></span>

                            <div class="admin_buttons">
                                <span>Edit</span>
                                <span>Delete</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="add_admin" id="formContainer">
                    <div class="admin_header">

                        <h2>Register Administrators</h2>
                        <i class="fa fa-times message_close" aria-hidden="true" onclick="popform()"></i>
                    </div>

                    <form action="<?= ROOT_URL ?>signup__logic.php" enctype="multipart/form-data" method="POST"
                        id="addAdmin">
                        <div class="input-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="input-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="input-group">
                            <label for="email">National ID *</label>
                            <input type="number" id="email" name="national" required>
                        </div>
                        <div class="input-group">
                            <label for="phone">Phone Number *</label>
                            <input type="phone" id="email" name="phone" required>
                        </div>
                        <div class="input-group">
                            <label for="salary">salary *</label>
                            <input type="number" id="salary" name="salary" required>
                        </div>

                        <div class="input-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="createpassword" required>
                        </div>
                        <div class="input-group">
                            <label for="confirm-password">Confirm Password *</label>
                            <input type="password" id="confirmpassword" name="confirmpassword" required>
                        </div>
                        <div class="input-group">
                            <label for="confirm-password">Avatar *</label>
                            <input type="file" id="avatar" name="avatar" required
                                style="border: none; color: slateblue;">
                        </div>
                        <button type="submit" name="" class="form-btn">Register Admin</button>

                    </form>
                </div>
            </div>
            <div id="settings-content" class="content-section" style="display: none;">Settings Content</div>
        </main>

        <!-- end of main -->

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span>
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </span>
                </button>
                <div class="theme-toggler">
                    <span><i class="fa fa-moon" aria-hidden="true"></i></span>
                    <span class="active"><i class="fa fa-sun" aria-hidden="true"></i>
                    </span>`
                </div>
                <?php

                if (isset($_SESSION['admin-id'])):
                    $id = $_SESSION['admin-id'];
                    $fetch_admin_query = "SELECT * FROM admins WHERE id = '$id'";
                    $run_query = mysqli_query($connection, $fetch_admin_query);
                    $admin_record = mysqli_fetch_assoc($run_query);

                    ?>
                    <div class="profile">
                        <div class="info">
                            <p><b><?php echo $admin_record['name'] ?></b></p>
                            <small class="text-muted">
                                Admin
                            </small>
                        </div>
                        <div class="profile-photo">
                            <img src="../profiles/<?php echo $admin_record['avatar'] ?>" alt="">
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- end of top -->
            <div class="recent-updates">
                <h2>Recent Students</h2>
                <div class="updates">
                    <?php
                    $fetch_recent_users_query = "SELECT * FROM users ORDER BY date DESC LIMIT 3";
                    $fetch_recent_users_result = mysqli_query($connection, $fetch_recent_users_query);
                    // Loop through fetched users and display each one
                    while ($user_record = mysqli_fetch_assoc($fetch_recent_users_result)):
                        ?>
                        <div class="update">
                            <div class="profile-photo">
                                <img src="../profiles/<?= $user_record['avatar'] ?>" alt="">
                            </div>
                            <div class="message">
                                <p><b><?= $user_record['name'] ?></b></p>
                                <small class="text-muted">
                                    <?php
                                    // Example time formatting logic
                                    $time_added = strtotime($user_record['date']);
                                    $time_diff = time() - $time_added;

                                    if ($time_diff < 60) {
                                        echo "$time_diff seconds ago";
                                    } elseif ($time_diff < 3600) {
                                        echo floor($time_diff / 60) . " minutes ago";
                                    } elseif ($time_diff < 86400) {
                                        echo floor($time_diff / 3600) . " hours ago";
                                    } else {
                                        echo date('M d, Y H:i:s', $time_added);
                                    }
                                    ?>
                                </small>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- End of Recent Updates -->

            <div class="sales-analytics">
                <h2>Users Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span>
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>NEW STUDENTS</h3>
                            <small class="text-muted">Last 24hrs</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>49</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>UNSUBSCRIBED STUDENTS</h3>
                            <small class="text-muted">Last 24hrs</small>
                        </div>
                        <h5 class="danger">14%</h5>
                        <h3>14</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div><span><i class="fa fa-plus" aria-hidden="true"></i></span></div>
                    <h3>Add Course Resource</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php

    // SQL query to fetch rows within the last seven days
    $sql = "SELECT * FROM users WHERE plan = 1";

    $result = $connection->query($sql);

    $premium_users = $result->num_rows;

    $query = "SELECT COUNT(*) AS row_count FROM users";
    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_assoc($result);
    $users = $row['row_count'];
    $basic_users = $users - $premium_users;

    ?>
    <script src="./index.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Users', 'Premium', 'Basic'],
                datasets: [{
                    label: 'Daily users',
                    data: [<?php echo $users ?>, <?php echo $premium_users ?>, <?php echo $basic_users ?>],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        const ctx1 = document.getElementById('myChart1');

        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Daily Financial Analytics',
                    data: [12, 19, 3, 5, 2, 3, 7],
                    borderWidth: 1
                }]
            },
            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    }
                },
                scales: {
                    y: { // defining min and max so hiding the dataset does not change scale range
                        min: 0,
                        max: 30
                    }
                }
            }
        });

    </script>
</body>
<!-- copyright @Briankipkemoi
 CREATED AND ONWNED BY BRIAN KIPKEMOI CHERUIYOT
 -->

</html>