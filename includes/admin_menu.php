<?php register_users_online();?>
<div class="container admin_menu">
                    <div class="row">
                        <div class="col-sm-12">



                            <ul>
                                <li><a href="dashboard.php"><i class="ti-dashboard"></i><span>Dashboard</span></a></li>
                                <li><a href="makedeposit.php"><i class="ti-cloud"></i><span>Deposit</span></a></li>

                                </li>
                                <li><a href="transactions.php"><i class="ti-briefcase"></i><span>Transactions</span></a></li>
                                <li><a href="withdraws.php"><i class="ti-download"></i><span>Withdraw</span></a></li>
                                <li><a href="yournetwork.php"><i class="ti-user"></i><span>Your Referrals</span></a></li>
                                <li><a href="profile.php"><i class="ti-lock"></i><span>profile</span></a></li>
                                <?php if (isAdminLoggedIn()) {
    echo ' <li><a href="admin_dashboard.php"><i class="ti-lock"></i><span>Admin</span></a></li>';}?>
                            </ul>





                        </div>
                    </div>
                </div>
