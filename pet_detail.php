
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
        <h1 class="display-4">/board/board_detail.php</h1>
        <?php
            //mysql 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "php", "1234","phpdb");
            //커넥션 객체 생성 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            // /board/board_list.php 에서 넘어온 글 번호 저장 및 출력
            $board_no = $_GET["board_no"];
            echo $board_no."번째 글 내용<br>";
            //board 테이블에서 board_no값이 일치하는 board_no, board_title, board_content, board_user, board_date 필드 값 조회 쿼리
            $sql = "SELECT board_no, board_title, board_content, board_user, image_path, board_date FROM pet WHERE board_no = '".$board_no."'";
            $result = mysqli_query($conn,$sql);
            //조회 성공 여부 확인
            if($result) {
                echo "조회 성공";
            } else {
                echo "결과 없음: ".mysqli_error($conn);
            }
        ?>
        <table class="table table-bordered" style="width:100%">
            <?php
                //result 변수에 담긴 값을 row 변수에 저장하여 테이블에 출력
                if($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td>
                    <?php
                        echo '<img src = "uploads/'.$row["image_path"].'" style="width:300px; heigth:300px">';
                    ?>
            </tr>
            <tr>
                <td >반려견명</td>
                <td >
                    <?php
                        echo $row["board_user"];
                    ?>
                </td>
            </tr>
            <tr>
                <td >글 제목</td>
                <td >
                    <?php
                        echo $row["board_title"];
                    ?>
                </td>
                <td >글 번호</td>
                <td >
                        <?php
                            echo $row["board_no"];
                        ?>
                </td>
                <td >작성 일자</td>
                <td >
                    <?php
                        echo $row["board_date"];
                    ?>
                </td>
                
            </tr>
            <tr>
                <td colspan="6">
                    <?php
                        echo $row["board_content"];
                    ?>
                </td>
            </tr>
            <?php
                            echo "<td><a href='/board/pet_update_form.php?board_no=".$row["board_no"]."'>수정</a></td>";
                            echo "<td><a href='/board/pet_delete_form.php?board_no=".$row["board_no"]."'>삭제</a></td>";
                        ?>
            <?php
                }
            ?>
        </table>
        <br>
        &nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary" href="/board/pet_list.php"> 리스트로 돌아가기</a>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>
