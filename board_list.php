
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
                        <?php
            $currentPage = 1;
            if (isset($_GET["currentPage"])) {
                $currentPage = $_GET["currentPage"];
            }
 
            //mysqli_connect()함수로 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "php", "1234","phpdb");
            //커넥션 객체 생성 확인
            // if($conn) {
            //     echo "연결 성공<br>";
            // } else {
            //     die("연결 실패 : " .mysqli_error());
            // }
            
            //페이징 작업을 위한 테이블 내 전체 행 갯수 조회 쿼리
            $sqlCount = "SELECT count(*) FROM board";
            $resultCount = mysqli_query($conn,$sqlCount);
            if($rowCount = mysqli_fetch_array($resultCount)){
                $totalRowNum = $rowCount["count(*)"];   //php는 지역 변수를 밖에서 사용 가능.
            }
            //행 갯수 조회 쿼리가 실행 됐는지 여부
            // if($resultCount) {
            //     echo "행 갯수 조회 성공 : ". $totalRowNum."<br>";
            // } else {
            //     echo "결과 없음: ".mysqli_error($conn);
            // }
                        
            $rowPerPage = 5;   //페이지당 보여줄 게시물 행의 수
            $begin = ($currentPage -1) * $rowPerPage;
            //board 테이블을 조회해서 board_no, board_title, board_user, board_date 필드 값을 내림차순으로 정렬하여 모두 가져 오는 쿼리
            //입력된 begin값과 rowPerPage 값에 따라 가져오는 행의 시작과 갯수가 달라지는 쿼리
            $sql = "SELECT board_no, board_title, board_user, image_path, board_date FROM board order by board_no desc limit ".$begin.",".$rowPerPage."";
            $result = mysqli_query($conn,$sql);
            //쿼리 조회 결과가 있는지 확인
            // if($result) {
            //     echo "조회 성공";
            // } else {
            //     echo "결과 없음: ".mysqli_error($conn);
            // }
        ?>
        <table class="table table-bordered">
            <tr>
                <td>board_no</td>
                <!-- <td>board_title</td>
                <td>board_user</td>
                <td>board_date</td>
                <td>수정</td>
                <td>삭제</td> -->
            </tr>
            <?php
                //반복문을 이용하여 result 변수에 담긴 값을 row변수에 계속 담아서 row변수의 값을 테이블에 출력한다.
                while($row = mysqli_fetch_array($result)){ 
            ?>
                <tr>
                    <?php
                        echo '<img src = "uploads/'.$row["image_path"].'" style="width:300px; heigth:300px">';
						echo "<a href='/board/board_detail.php?board_no=".$row["board_no"]."'>";
						echo $row["board_title"];
						echo "</a>";
                    ?>
                    
                </tr>
            <?php
                }
            ?>
        </table>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php
            //currentPage 변수가 1보다 클때만 이전 버튼이 활성화 되도록 함
            if($currentPage > 1 ) { 
                //이전 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 뺀 값이 넘어가도록 함
                echo "<a class='btn btn-primary' href ='/board/board_list.php?currentPage=".($currentPage-1)."'>이전</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
 
            $lastPage = ($totalRowNum-1) / $rowPerPage;
 
            if (($totalRowNum-1) % $rowPerPage !=0) { 
                $lastPage += 1;
            }
            //lastPage변수가 currentPage 변수보다 클때만 다음 버튼이 활성화 되도록 함
            if($currentPage < $lastPage) { 
                //다음 버튼이 클릭될때 GET방식으로 currentPage변수 값에 1을 더한 값이 넘어가도록 함
                echo "<a class='btn btn-primary' href='/board/board_list.php?currentPage=".($currentPage+1)."'>다음</a>";
            }
            mysqli_close($conn);
        ?>
        &nbsp;&nbsp;
        <a class="btn btn-primary" href="/board/board_add_form.php">글 쓰기</a>
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
