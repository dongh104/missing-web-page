<html>
    <head>
    </head>
    <body>
        <h1>/board/boardAddAction.php</h1>
        <?php

            $target_dir = "./uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "<p>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
                    echo "<br><img src=/uploads/". basename( $_FILES["fileToUpload"]["name"]). ">";
                    echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
                } else {
                    echo "<p>Sorry, there was an error uploading your file.</p>";
                    echo "<br><button type='button' onclick='history.back()'>돌아가기</button>";
                }
            }

            // /board/board_add_form.php 페이지에서 넘어온 글 번호값 저장 및 출력
            $board_pw = $_POST["boardPw"];
            $board_title = $_POST["boardTitle"];
            $board_content = $_POST["boardContent"];
            $board_user = $_POST["boardUser"];
            $board_image = $_FILES["fileToUpload"]["name"];
            echo "board_pw : " . $board_pw . "<br>";
            echo "board_title : " . $board_title . "<br>";
            echo "board_content : " . $board_content . "<br>";
            echo "board_user : " . $board_user . "<br>";
            //mysql 커넥션 객체 생성
            $conn = mysqli_connect("localhost", "php", "1234","phpdb");
            //커넥션 객체 생성 여부 확인
            if($conn) {
                echo "연결 성공<br>";
            } else {
                die("연결 실패 : " .mysqli_error());
            }
            //board 테이블에 입력된 값을 1행에 넣고 board_date 필드에는 현재 시간을 입력하는 쿼리
            $sql = "INSERT INTO pet (board_pw, board_title, board_content, board_user, image_path, board_date) values ('".$board_pw."','".$board_title."','".$board_content."','".$board_user."', '".$board_image."', now())";
            $result = mysqli_query($conn,$sql);
            // 쿼리 실행 여부 확인
            if($result) {
                echo "입력 성공: ".$result; //과제 작성시 에러메시지 출력하게 만들기
            } else {
                echo "입력 실패: ".mysqli_error($conn);
            }
            mysqli_close($conn);
            //헤더함수를 이용하여 리스트 페이지로 리다이렉션
            header("Location:/board/pet_list.php"); //헤더 함수를 이용해서 리다이렉션 시킬 수 있다.
        ?>
    </body
</html>
