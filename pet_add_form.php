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
        <h1 class="display-4">실종 신고 게시판</h1>
        <!-- /board/board_add_action.php로 넘기는 폼 -->
        <form class="form-horizontal" action="/board//pet_add_action.php" method="post", enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputName1" class="col-sm-2 control-label">반려동물 : </label>
                <div class="col-sm-10">
                    <!-- 작성자명 입력 상자 -->
                    <input class="form-control" name="boardUser" id="name" type="text" placeholder="Name"/>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">비밀번호 : </label>
                <div class="col-sm-10">
                    <!-- 글 비밀번호 입력 상자 -->
                    <input class="form-control" name="boardPw" id="password" type="password" placeholder="Password"/>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputTitle1" class="col-sm-2 control-label">글 제목 : </label>
                <div class="col-sm-10">
                    <!-- 글 제목 입력 상자 -->
                    <input class="form-control" name="boardTitle" id="Title" type="text" placeholder="Title"/>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputContent1" class="col-sm-2 control-label">글 내용 : </label>
                <div class="col-sm-10">
                    <!-- 글 내용 입력 텍스트영역 -->
                    <textarea class="form-control" name="boardContent" id="content" rows="5" cols="50" placeholder="Content"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputContent1" class="col-sm-2 control-label">글 내용 : </label>
                <div class="col-sm-10">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <!-- <input type="submit" value="Upload Image" name="submit"> -->
                </div>
            </div>
            
            
            <div>
                &nbsp;&nbsp;&nbsp;
                <!-- 글 입력 버튼 -->
                <button class="btn btn-primary" type="submit" value="글 입력">글 입력</button>
                &nbsp;&nbsp;
                <!-- 입력 내용 초기화 버튼 -->
                <button class="btn btn-primary" type="reset" value="초기화">초기화</button>
                &nbsp;&nbsp;
                <!-- 리스트로 돌아가는 버튼 -->
                <a class="btn btn-primary" href="/board/pet_list.php">리스트로 돌아가기</a>
            </div>
        </form>
        <script type="text/javascript">
            //id가 XX인 객체에 변화가 생기면 checkXX 함수를 변화된 객체의 값을 매개로 호출
            $("#password").change(function(){
                checkPassword($('#password').val());
            });
            $("#Title").change(function(){
                checkTitle($('#Title').val());
            });
            $("#content").change(function(){
                checkTitle($('#content').val());
            });
            $("#name").change(function(){
                checkName($('#name').val());
            });
            //입력된 변수의 길이를 참조하여 조건문을 통해 최소 입력 길이 유효성 검사를 하는 함수
            function checkPassword(password) { 
                if(password.length < 4) { 
                    alert("비밀번호는 4자 이상 입력하여야 합니다."); 
                    $('#password').val('').focus();
                    return false;
                } else { 
                    return true;
                } 
            } 
            
            function checkTitle(Title) {
                if(Title.length < 2) {
                    alert('제목은 2자 이상 입력해야 합니다.');
                    $('#Title').val('').focus();
 
                    return false;
                } else { 
                    return true;
                } 
            }
 
            function checkContent(content) {
                if(content.length < 2) {            
                    alert('내용은 2자리 이상 입력해야 합니다.');
                    $('#content').val('').focus();
                    return false;
                } else { 
                    return true;
                } 
            }
 
            function checkName(name) {
                if(name.length < 2) {            
                    alert('작성자명은 2자리 이상 입력해야 합니다.');
                    $('#name').val('').focus();
                    return false;
                } else { 
                    return true;
                } 
            }
        </script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </body>
</html>