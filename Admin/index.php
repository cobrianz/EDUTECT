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
                <a href="#" id="dashboard-link" class="active">
                    <span><i class="fa fa-th-large" aria-hidden="true"></i></span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" id="students-link">
                    <span><i class="fa fa-user" aria-hidden="true"></i></span>
                    <h3>Students</h3>
                </a>
                <a href="#" id="analytics-link">
                    <span><i class="fa fa-line-chart" aria-hidden="true"></i></span>
                    <h3>Analytics</h3>
                </a>
                <a href="#" id="messages-link">
                    <span><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
                    <h3>Messages</h3>
                    <span class="message-count">26</span>
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
                <div class="date">
                    <input type="date">
                </div>

                <div class="insights">

                    <!-- end of sales -->
                    <div class="expenses">
                        <span>
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        </span>
                        <div class="middle">
                            <div class="left">
                                <h3>New Income</h3>
                                <h1>Ksh. 140,000</h1>
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
                        <small class="text-muted">Last 24 hours</small>
                    </div>
                    <!-- end of Expenses -->
                    <div class="income">
                        <span>
                            <i class="fa fa-area-chart" aria-hidden="true"></i>
                        </span>
                        <div class="middle">
                            <div class="left">
                                <h3>Total income</h3>
                                <h1>Ksh. 500,000</h1>
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
                        <small class="text-muted">Last 24 hours</small>
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
                    <h2>Recent Students</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Plan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // Fetch user data from the database
                            $fetch_user_query = "SELECT * FROM users";
                            $fetch_user_result = mysqli_query($connection, $fetch_user_query);

                            // Convert the record into an associative array
                            while ($user_record = mysqli_fetch_assoc($fetch_user_result)):

                                ?>
                                <tr>
                                    <td><img src="../profiles/<?= $user_record['avatar'] ?>" alt=""></td>
                                    <td><?= $user_record['name'] ?></td>
                                    <td><?= $user_record['email'] ?></td>
                                    <?php if ($user_record['plan'] == 0): ?>
                                        <td class="warning">Basic</td>
                                    <?php elseif ($user_record['plan'] == 1): ?>
                                        <td class="primary">Premium</td>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <a href="#">Show All</a>
                </div>
            </div>
            <div id="students-content" class="content-section" style="display: none;">
                <div class="recent-orders">
                    <h2>All Students</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Plan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // Fetch user data from the database
                            $fetch_user_query = "SELECT * FROM users";
                            $fetch_user_result = mysqli_query($connection, $fetch_user_query);

                            // Convert the record into an associative array
                            while ($user_record = mysqli_fetch_assoc($fetch_user_result)):

                                ?>
                                <tr>
                                    <td><img src="../profiles/<?= $user_record['avatar'] ?>" alt=""></td>
                                    <td><?= $user_record['name'] ?></td>
                                    <td><?= $user_record['email'] ?></td>
                                    <?php if ($user_record['plan'] == 0): ?>
                                        <td class="warning">Basic</td>
                                    <?php elseif ($user_record['plan'] == 1): ?>
                                        <td class="primary">Premium</td>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <a href="#">Show All</a>
                </div>
            </div>
            <div id="analytics-content" class="content-section" style="display: none;">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
                <div>
                    <canvas id="myChart1"></canvas>
                </div>
            </div>
            <div id="messages-content" class="content-section" style="display: none;">Messages Content</div>
            <div id="admins-content" class="content-section" style="display: none;">Admins Content</div>
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
                    <span class="active"><i class="fa fa-sun" aria-hidden="true"></i>
                    </span>`
                    <span><i class="fa fa-moon" aria-hidden="true"></i></span>
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
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/profile-2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Brian Cheruiyot</b></p>
                            <small class="text-muted">2 minutes ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/profile-3.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Cyrus Cheruiyot</b></p>
                            <small class="text-muted">5 minutes ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./images/profile-4.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>Maureen Cheruiyot</b></p>
                            <small class="text-muted">8 minutes ago</small>
                        </div>
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
    <script src="./index.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
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
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1
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
    </script>
</body>
<!-- copyright @Briankipkemoi
 CREATED AND ONWNED BY BRIAN KIPKEMOI CHERUIYOT
 -->

</html>