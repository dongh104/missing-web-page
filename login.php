
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
								<a href="index.html" class="logo">
									<span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">신고 게시판 사이트</span>
								</a>

							<!-- Nav -->
								<nav>
									<ul>
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
							<li><a href="board/pet_list.php">반려견 신고 게시판</a></li>
                            <?php
                                session_start(); // 세션
                                if($_SESSION['id']==null) { // 로그인 하지 않았다면
                            ?>
							<li><a href="/board/login.php">로그인</a></li>
							<li><a href="/board/register.php">회원가입</a></li>
                            <?php
                                }else{
                                    echo "<script>location.href='/board/index.php';</script>";
                                }
                            ?>

						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
						<div class="inner">
							<header>
								<h1>로그인 페이지</h1>
								<p>Html, PHP, Mysql 을 이용하여 만들어진 사이트입니다.</p>
							</header>
							<section class="tiles">
								<article class="style2">
                                <form name="login_form" action="/board/login_check.php" method="post"> 
                                    ID : <input type="text" name="id"><br> 
                                    PassWord:<input type="password" name="pw"><br><br>
                                    <input type="submit" name="login" value="Login"> 
                                    </form>
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
