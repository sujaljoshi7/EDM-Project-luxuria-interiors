<?php
include '../dbconnect.php';
session_start();
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] != true) {
	header("location: login.php");
	exit;
}
$fetchordersql = "SELECT * FROM orders ORDER BY o_id DESC";
$fetchorders = mysqli_query($conn, $fetchordersql);

$fetchconfirmedordersql = "SELECT * FROM orders where status = 0";
$fetchconfirmedorders = mysqli_query($conn, $fetchconfirmedordersql);

$fetchcancelledordersql = "SELECT * FROM orders where status = -1";
$fetchcencelledorders = mysqli_query($conn, $fetchcancelledordersql);

$fetchdeliveredordersql = "SELECT * FROM orders where status = 4";
$fetchdeliveredorders = mysqli_query($conn, $fetchdeliveredordersql);



?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>luxuria interiors admin</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Admin panel for luxuria interiors">
	<meta name="author" content="Sujal Joshi">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app">
	<header class="app-header fixed-top">
		<div class="app-header-inner">
			<div class="container-fluid py-2">
				<div class="app-header-content">
					<div class="row justify-content-between align-items-center">

						<div class="col-auto">
							<a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30"
									role="img">
									<title>Menu</title>
									<path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
										stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
								</svg>
							</a>
						</div>
						<!--//col-->
						<div class="search-mobile-trigger d-sm-none col">
							<i class="search-mobile-trigger-icon fa-solid fa-magnifying-glass"></i>
						</div>
						<!--//col-->
						<div class="app-search-box col">
							<form class="app-search-form">
								<input type="text" placeholder="Search..." name="search"
									class="form-control search-input">
								<button type="submit" class="btn search-btn btn-primary" value="Search"><i
										class="fa-solid fa-magnifying-glass"></i></button>
							</form>
						</div>
						<!--//app-search-box-->

						<div class="app-utilities col-auto">

							<div class="app-utility-item app-user-dropdown dropdown">
								<a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#"
									role="button" aria-expanded="false"><img src="assets/images/user.png"
										alt="user profile"></a>
								<ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
									<li><a class="dropdown-item" href="account.html">Account</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="login.html">Log Out</a></li>
								</ul>
							</div>
							<!--//app-user-dropdown-->
						</div>
						<!--//app-utilities-->
					</div>
					<!--//row-->
				</div>
				<!--//app-header-content-->
			</div>
			<!--//container-fluid-->
		</div>
		<!--//app-header-inner-->
		<div id="app-sidepanel" class="app-sidepanel">
			<div id="sidepanel-drop" class="sidepanel-drop"></div>
			<div class="sidepanel-inner d-flex flex-column">
				<a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
				<div class="app-branding">
					<a class="app-logo" href="index.php"><img class="logo-icon me-2" src="round_logo.png"
							alt="logo"><span class="logo-text">luxwatches admin</span></a>

				</div>
				<!--//app-branding-->

				<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
					<ul class="app-menu list-unstyled accordion" id="menu-accordion">
						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="index.php">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door"
										fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
											d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
										<path fill-rule="evenodd"
											d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
									</svg>
								</span>
								<span class="nav-link-text">Dashboard</span>
							</a>
							<!--//nav-link-->
						</li>
						<!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="products.php">
								<span class="nav-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-box-seam" viewBox="0 0 16 16">
										<path
											d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
									</svg>
								</span>
								<span class="nav-link-text">Products</span>
							</a>
							<!--//nav-link-->
						</li>
						<!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="categories.php">
								<span class="nav-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-grid" viewBox="0 0 16 16">
										<path
											d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z" />
									</svg>
								</span>
								<span class="nav-link-text">Categories</span>
							</a>
							<!--//nav-link-->
						</li>
						<!--//nav-item-->

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link active" href="orders.php">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list"
										fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
											d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
										<path fill-rule="evenodd"
											d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z" />
										<circle cx="3.5" cy="5.5" r=".5" />
										<circle cx="3.5" cy="8" r=".5" />
										<circle cx="3.5" cy="10.5" r=".5" />
									</svg>
								</span>
								<span class="nav-link-text">Orders</span>
							</a>
							<!--//nav-link-->
						</li>

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="orders.php">
								<span class="nav-icon">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-chat-square-dots" viewBox="0 0 16 16">
										<path
											d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
										<path
											d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
									</svg>
								</span>
								<span class="nav-link-text">Messages</span>
							</a>
							<!--//nav-link-->
						</li>

						<li class="nav-item">
							<!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
							<a class="nav-link" href="help.html">
								<span class="nav-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-question-circle"
										fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
											d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
										<path
											d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
									</svg>
								</span>
								<span class="nav-link-text">Help</span>
							</a>
							<!--//nav-link-->
						</li>
						<!--//nav-item-->
					</ul>
					<!--//app-menu-->
				</nav>
				<!--//app-nav-->

			</div>
			<!--//sidepanel-inner-->
		</div>
		<!--//app-sidepanel-->
	</header>
	<!--//app-header-->

	<div class="app-wrapper">

		<form action="#" method="post">
			<div class="app-content pt-3 p-md-3 p-lg-4">
				<div class="container-xl">

					<div class="row g-3 mb-4 align-items-center justify-content-between">
						<div class="col-auto">
							<h1 class="app-page-title mb-0">Orders</h1>
						</div>
					</div><!--//row-->


					<nav id="orders-table-tab"
						class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
						<a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab"
							href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
						<a class="flex-sm-fill text-sm-center nav-link" id="orders-paid-tab" data-bs-toggle="tab"
							href="#orders-paid" role="tab" aria-controls="orders-paid"
							aria-selected="false">Delivered</a>
						<a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab"
							href="#orders-pending" role="tab" aria-controls="orders-pending"
							aria-selected="false">Confirmed</a>
						<a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab"
							href="#orders-cancelled" role="tab" aria-controls="orders-cancelled"
							aria-selected="false">Cancelled</a>
					</nav>


					<div class="tab-content" id="orders-table-tab-content">
						<div class="tab-pane fade show active" id="orders-all" role="tabpanel"
							aria-labelledby="orders-all-tab">
							<div class="app-card app-card-orders-table shadow-sm mb-5">
								<div class="app-card-body">
									<div class="table-responsive">
										<table class="table app-table-hover mb-0 text-left">
											<thead>
												<tr>
													<th class="cell">Order</th>
													<th class="cell">Customer</th>
													<th class="cell">Date</th>
													<th class="cell">Type</th>
													<th class="cell">Status</th>
													<th class="cell">Total</th>
													<th class="cell"></th>
												</tr>
											</thead>
											<tbody>
												<?php

												while ($row = mysqli_fetch_assoc($fetchorders)) {
													?>
													<tr>
														<td class="cell">#<?php echo $row['order_id'] ?></td>
														<td class="cell"><?php echo $row['f_name'], " ", $row['l_name'] ?>
														</td>
														<td class="cell"><span><?php echo $row['date'] ?></span><span
																class="note"><?php echo substr($row['time'], 0, -1); ?></span>
														</td>
														<td class="cell"><?php echo $row['type'] ?></td>
														<?php
														$order_status = $row['status'];
														if ($order_status == '-1') {
															?>
															<td class="cell"><span class="badge bg-danger">Order
																	Cancelled</span>
															</td><?php
														}
														if ($order_status == '0') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Confirmed</span>
															</td><?php
														}
														if ($order_status == '1') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Packed</span>
															</td><?php
														}
														if ($order_status == '2') {
															?>
															<td class="cell"><span class="badge bg-warning">In Transit</span>
															</td><?php
														}
														if ($order_status == '3') {
															?>
															<td class="cell"><span class="badge bg-warning">Out for
																	delivery</span>
															</td><?php
														}
														if ($order_status == '4') {
															?>
															<td class="cell"><span class="badge bg-success">Delivered</span>
															</td><?php
														}
														?>
														<td class="cell">
															₹<?php echo number_format($row['total'], 0, '', ','); ?></td>
														<td class="cell"><a class="btn-sm app-btn-secondary" target="_blank"
																href="order-details.php?o_id=<?php echo $row['o_id']; ?>">View</a>
														</td>
													</tr>
													<?php
												}
												?>

											</tbody>
										</table>
									</div><!--//table-responsive-->

								</div><!--//app-card-body-->
							</div><!--//app-card-->
							<nav class="app-pagination">
								<ul class="pagination justify-content-center">
									<li class="page-item disabled">
										<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
									</li>
									<li class="page-item active"><a class="page-link" href="#">1</a></li>
									<li class="page-item"><a class="page-link" href="#">2</a></li>
									<li class="page-item"><a class="page-link" href="#">3</a></li>
									<li class="page-item">
										<a class="page-link" href="#">Next</a>
									</li>
								</ul>
							</nav><!--//app-pagination-->

						</div><!--//tab-pane-->

						<div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
							<div class="app-card app-card-orders-table mb-5">
								<div class="app-card-body">
									<div class="table-responsive">

										<table class="table mb-0 text-left">
											<thead>
												<tr>
													<th class="cell">Order</th>
													<th class="cell">Customer</th>
													<th class="cell">Date</th>
													<th class="cell">Type</th>
													<th class="cell">Status</th>
													<th class="cell">Total</th>
													<th class="cell"></th>
												</tr>
											</thead>
											<tbody>
												<?php
												while ($row = mysqli_fetch_assoc($fetchdeliveredorders)) {
													?>
													<tr>
														<td class="cell">#<?php echo $row['order_id'] ?></td>
														<td class="cell"><?php echo $row['f_name'], " ", $row['l_name'] ?>
														</td>
														<td class="cell"><span><?php echo $row['date'] ?></span><span
																class="note"><?php echo substr($row['time'], 0, -1); ?></span>
														</td>
														<td class="cell"><?php echo $row['type'] ?></td>
														<?php
														$order_status = $row['status'];
														if ($order_status == '-1') {
															?>
															<td class="cell"><span class="badge bg-danger">Order
																	Cancelled</span>
															</td><?php
														}
														if ($order_status == '0') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Confirmed</span>
															</td><?php
														}
														if ($order_status == '1') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Packed</span>
															</td><?php
														}
														if ($order_status == '2') {
															?>
															<td class="cell"><span class="badge bg-warning">In Transit</span>
															</td><?php
														}
														if ($order_status == '3') {
															?>
															<td class="cell"><span class="badge bg-warning">Out for
																	delivery</span>
															</td><?php
														}
														if ($order_status == '4') {
															?>
															<td class="cell"><span class="badge bg-success">Delivered</span>
															</td><?php
														}
														?>
														<td class="cell">
															₹<?php echo number_format($row['total'], 0, '', ','); ?></td>
														<td class="cell"><a class="btn-sm app-btn-secondary" target="_blank"
																href="order-details.php?o_id=<?php echo $row['o_id']; ?>">View</a>
														</td>
													</tr>
													<?php
												}
												?>

											</tbody>
										</table>
									</div><!--//table-responsive-->
								</div><!--//app-card-body-->
							</div><!--//app-card-->
						</div><!--//tab-pane-->

						<div class="tab-pane fade" id="orders-pending" role="tabpanel"
							aria-labelledby="orders-pending-tab">
							<div class="app-card app-card-orders-table mb-5">
								<div class="app-card-body">
									<div class="table-responsive">
										<table class="table mb-0 text-left">
											<thead>
												<tr>
													<th class="cell">Order</th>
													<th class="cell">Customer</th>
													<th class="cell">Date</th>
													<th class="cell">Type</th>
													<th class="cell">Status</th>
													<th class="cell">Total</th>
													<th class="cell"></th>
												</tr>
											</thead>
											<tbody>
												<?php

												while ($row = mysqli_fetch_assoc($fetchconfirmedorders)) {
													?>
													<tr>
														<td class="cell">#<?php echo $row['order_id'] ?></td>
														<td class="cell"><?php echo $row['f_name'], " ", $row['l_name'] ?>
														</td>
														<td class="cell"><span><?php echo $row['date'] ?></span><span
																class="note"><?php echo substr($row['time'], 0, -1); ?></span>
														</td>
														<td class="cell"><?php echo $row['type'] ?></td>
														<?php
														$order_status = $row['status'];
														if ($order_status == '-1') {
															?>
															<td class="cell"><span class="badge bg-danger">Order
																	Cancelled</span>
															</td><?php
														}
														if ($order_status == '0') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Confirmed</span>
															</td><?php
														}
														if ($order_status == '1') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Packed</span>
															</td><?php
														}
														if ($order_status == '2') {
															?>
															<td class="cell"><span class="badge bg-warning">In Transit</span>
															</td><?php
														}
														if ($order_status == '3') {
															?>
															<td class="cell"><span class="badge bg-warning">Out for
																	delivery</span>
															</td><?php
														}
														if ($order_status == '4') {
															?>
															<td class="cell"><span class="badge bg-success">Delivered</span>
															</td><?php
														}
														?>
														<td class="cell">
															₹<?php echo number_format($row['total'], 0, '', ','); ?></td>
														<td class="cell"><a class="btn-sm app-btn-secondary" target="_blank"
																href="order-details.php?o_id=<?php echo $row['o_id']; ?>">View</a>
														</td>
													</tr>
													<?php
												}
												?>

											</tbody>
										</table>
									</div><!--//table-responsive-->
								</div><!--//app-card-body-->
							</div><!--//app-card-->
						</div><!--//tab-pane-->
						<div class="tab-pane fade" id="orders-cancelled" role="tabpanel"
							aria-labelledby="orders-cancelled-tab">
							<div class="app-card app-card-orders-table mb-5">
								<div class="app-card-body">
									<div class="table-responsive">
										<table class="table mb-0 text-left">
											<thead>
												<tr>
													<th class="cell">Order</th>
													<th class="cell">Customer</th>
													<th class="cell">Date</th>
													<th class="cell">Type</th>
													<th class="cell">Status</th>
													<th class="cell">Total</th>
													<th class="cell"></th>
												</tr>
											</thead>
											<tbody>
												<?php

												while ($row = mysqli_fetch_assoc($fetchcencelledorders)) {
													?>
													<tr>
														<td class="cell">#<?php echo $row['order_id'] ?></td>
														<td class="cell"><?php echo $row['f_name'], " ", $row['l_name'] ?>
														</td>
														<td class="cell"><span><?php echo $row['date'] ?></span><span
																class="note"><?php echo substr($row['time'], 0, -1); ?></span>
														</td>
														<td class="cell"><?php echo $row['type'] ?></td>
														<?php
														$order_status = $row['status'];
														if ($order_status == '-1') {
															?>
															<td class="cell"><span class="badge bg-danger">Order
																	Cancelled</span>
															</td><?php
														}
														if ($order_status == '0') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Confirmed</span>
															</td><?php
														}
														if ($order_status == '1') {
															?>
															<td class="cell"><span class="badge bg-secondary">Order
																	Packed</span>
															</td><?php
														}
														if ($order_status == '2') {
															?>
															<td class="cell"><span class="badge bg-warning">In Transit</span>
															</td><?php
														}
														if ($order_status == '3') {
															?>
															<td class="cell"><span class="badge bg-warning">Out for
																	delivery</span>
															</td><?php
														}
														if ($order_status == '4') {
															?>
															<td class="cell"><span class="badge bg-success">Delivered</span>
															</td><?php
														}
														?>
														<td class="cell">
															₹<?php echo number_format($row['total'], 0, '', ','); ?></td>
														<td class="cell"><a class="btn-sm app-btn-secondary" target="_blank"
																href="order-details.php?o_id=<?php echo $row['o_id']; ?>">View</a>
														</td>
													</tr>
													<?php
												}
												?>

											</tbody>
										</table>
									</div><!--//table-responsive-->
								</div><!--//app-card-body-->
							</div><!--//app-card-->
						</div><!--//tab-pane-->
					</div><!--//tab-content-->



				</div><!--//container-fluid-->
			</div><!--//app-content-->
		</form>

		<footer class="app-footer">
			<div class="container text-center py-3">
				<!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
				<small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart"
						style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com"
						target="_blank">Xiaoying Riley</a> for developers</small>

			</div>
		</footer><!--//app-footer-->

	</div><!--//app-wrapper-->


	<!-- Javascript -->
	<script src="assets/plugins/popper.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>


	<!-- Page Specific JS -->
	<script src="assets/js/app.js"></script>

</body>

</html>