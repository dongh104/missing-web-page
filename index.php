
<!DOCTYPE HTML>
<html>
	<head>
		<title>신고 게시판</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->
								<a href="/board/index.php" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">신고 게시판 사이트</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
									<?php
										session_start(); // 세션
										if($_SESSION['id']==null) { // 로그인 하지 않았다면
										?>
										<li>
											<form method="post" action="/board/login_check.php">
												<!-- <div class="fields"> -->
													<div class="field">
														<input type="text" name="id" id="id" placeholder="Name" />
														<input type="password" name="pw" id="pw" placeholder="Password" />
														<input type="submit" name="login" value="Login">
													</div>
												<!-- </div> -->
												
											</form>
										</li>
										<!-- <li><input type="submit" value="Send" class="primary" /></li> -->
										<?php
											}else{ // 로그인 했다면
											// echo "<center><br><br><br>";
											echo $_SESSION['username']."님이 로그인 하였습니다.";
											// echo "&nbsp;<a href='/board/logout.php'><input type='button' value='Logout'></a>";
											// echo "</center>";
											}
											?>
										<li>
											<a href="#menu">Menu</a>
										</li>
									</ul>
								</nav>
						</div>
					</header>

				<!-- Menu -->
					<nav id="menu">
						<h2>Menu</h2>
						<ul>
							<li><a href="/board/index.php">메인페이지</a></li>
							<li><a href="/board/intro.php">소개글</a></li>
							<li><a href="/board/board_list.php">실종자 신고 게시판</a></li>
							<li><a href="/board/pet_list.php">반려견 신고 게시판</a></li>
							<?php
                                session_start(); // 세션
                                if($_SESSION['id']==null) { // 로그인 하지 않았다면
                            ?>
							<li><a href="/board/login.php">로그인</a></li>
							<li><a href="/board/register.php">회원가입</a></li>
							<?php
								}else{
									echo'<li><a href="/board/logout.php">로그아웃</a></li>';
								}
							?>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>실종 신고, 반려견 실종 신고 등을 위한 사이트입니다.<br />
							</header>
							<section class="tiles">
								<article class="style1">
									<span class="image">
										<img src="images/pic01.jpg" alt="" />
									</span>
									<a href="/board/intro.php">
										<h2>소개글</h2>
										<div class="content">
											<p>사이트를 소개합니다.</p>
										</div>
									</a>
								</article>
								<article class="style2">
									<span class="image">
										<img src="images/pic02.jpg" alt="" />
									</span>
									<a href="/board/board_list.php">
										<h2>실종자 신고 게시판</h2>
										<div class="content">
											<p>실종자 신고를 위한 게시판입니다.</p>
										</div>
									</a>
								</article>
								<article class="style3">
									<span class="image">
										<img src="images/pic03.jpg" alt="" />
									</span>
									<a href="/board/pet_list.php">
										<h2>반려견 신고 게시판</h2>
										<div class="content">
											<p>반려견 신고를 위한 게시판입니다.</p>
										</div>
									</a>
								</article>
							</section>
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<ul class="copyright">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
