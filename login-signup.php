<?php
require('config.php') ;
foreach ($_GET as $key_get => $value_get){
	$_GET[$key_get]   = $db -> escape($_GET[$key_get]) ;
}
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
	$ip=$_SERVER['HTTP_CLIENT_IP'];
}else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
	$ip=$_SERVER['REMOTE_ADDR'];
}

function randtext($length) {
    $password_len = $length;    //字串長度
    $password = '';
    $word = 'abcdefghijklmnopqrstuvwxyz0123456789';   //亂數內容
    $len = strlen($word);
    for ($i = 0; $i < $password_len; $i++) {
        $password .= $word[rand() % $len];
    }
    return $password;
}


//會員登入
if( isset($_POST['memberLogin']) ){
	if( $_POST['email']!=null && $_POST['password']!=null && ValidateEmailAddress($_POST['email']) == true ){
		$record = $db -> getfirst("select * from member where DELETE_ID =0 and EMAIL ='".$_POST['email']."' and PASSWORD = '".$_POST['password']."'") ;
		if( $record['ITEM']!=null ){
			if( $record['STATUS']==1 ){
				$_SESSION['user_id'] = $record['ITEM'] ;
				$db -> update("update member set IP ='".$ip."' where ITEM ='".$_SESSION['user_id']."'") ;
				header("Location: member.php") ;
				exit ; 
			}else{
				header("Location: login-signup.php?send=statusError") ;
				exit ; 
			}
		}else{
			header("Location: login-signup.php?send=loginError") ;
			exit ; 
		}
	}else{
		header("Location: login-signup.php?send=loginError2") ;
		exit ; 
	}
}

//會員註冊
if( isset($_POST['memberReg']) ){
	if( $_POST['email']!=null && $_POST['password']!=null && $_POST['password']==$_POST['password1'] && $_POST['name'] !=null && ValidateEmailAddress($_POST['email']) == true ){


		$record = $db -> getfirst("select * from member where DELETE_ID =0 and EMAIL ='".$_POST['email']."'") ;
		if( $record['ITEM']==null ){
			if( $db -> insert("Insert into member( NAME , EMAIL , PASSWORD , IP , CATE_INDEX , DOC_PATH , MODEFY_TIME , SET_TIME , DELETE_ID , MEMBER_NUM , DOC_LEVEL ) values 
			( '".$_POST['name']."' , '".$_POST['email']."' , '".$_POST['password']."' , '".$ip."' , 0 , '0<br>' , now() , now() , 0 , 1 , 1 )") ){
				$insert_id = $db ->getid() ;
				$db -> update("update member set SORT ='".$insert_id."' where ITEM ='".$insert_id."'") ;
				$guest = $insert_id;
				$_SESSION['user_id'] = $insert_id ;

				$mailcontent ="註冊成功，請點選此<a href=\"".$system_true_path."checkout.php?member=".base64_encode($insert_id)."&email=".base64_encode($_POST['email'])."\" style=\"color:#ff0000;\">網址</a>，或複製".$system_true_path."checkout.php?member=".base64_encode($insert_id)."&email=".base64_encode($_POST['email'])."，謝謝。<br /><br />" ;
				$to_mail = $_POST['email'] ;
				$mail_topic = "WGGT-會員註冊確認" ;
				$from_mail = "WGGT@wg-coin.com.tw" ;
				Sent_Email($to_mail,$from_mail,$mail_topic,$mailcontent) ;

				header("Location: member.php?send=ok") ;
				exit ; 
			}else{
				header("Location: login-signup.php?send=error") ;
				exit ; 
			}
		}else{
			header("Location: login-signup.php?send=repeat") ;
			exit ; 
		}

	}else{
		header("Location: login-signup.php?send=error") ;
		exit ; 
	}
}
//忘記密碼
if( isset($_POST['forgetPassword']) ){
	if( $_POST['email']!=null && ValidateEmailAddress($_POST['email']) == true ){
		$record = $db -> getfirst("select * from member where DELETE_ID =0 and EMAIL ='".$_POST['email']."'") ;
		$content = "您的密碼為：".$record['PASSWORD']."<br />" ;
		$to_mail = $_POST['email'] ;
		$mail_topic = "WGGT-忘記密碼" ;
		$from_mail = "WGGT@wg-coin.com.tw" ;
		Sent_Email($to_mail,$from_mail,$mail_topic,$content) ;
		header("Location: .?forgetsend=ok") ;
		exit ; 
	}else{
		header("Location: .?forgetsend=error") ;
		exit ; 
	}
}

/*






//會員修改密碼
if( isset($_POST['changePassword']) ){
	if( $_POST['old_password']!=null && $_POST['new_password']!=null && $_POST['confirm_password']!=null && ( $_POST['new_password'] == $_POST['confirm_password'] ) ){
		$record = $db -> getfirst("select * from member where DELETE_ID =0 and ONLINE =1 and ITEM ='".$_SESSION['user_id']."' and PASSWORD = '".addslashes($_POST['old_password'])."'") ;
		if( $record['ITEM']!=null ){
			$db -> update("update member set PASSWORD ='".addslashes($_POST['confirm_password'])."' where ITEM ='".$_SESSION['user_id']."'") ;
			header("Location: .?update=success") ;
			exit ; 
		}else{
			header("Location: .?update=error") ;
			exit ; 
		}
	}else{
		header("Location: .?update=error") ;
		exit ; 
	}
}
*/


//會員資料
if(isset($_SESSION['user_id'])){
	$member = $db -> getfirst("select * from member where DELETE_ID =0 and ITEM ='".$_SESSION['user_id']."'") ;
} 
$web_config = $db -> getfirst("select * from web_config where DELETE_ID =0") ;
?>
<!DOCTYPE html>
<html lang="zh-Hant" class="js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Language" content="zh-tw" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Fav Icon  -->
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/favicon//apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicon//apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/favicon//apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicon//apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/favicon//apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/favicon//apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/favicon//apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon//apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="images/favicon//android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon//favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon//favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/favicon//favicon-16x16.png">
	<link rel="manifest" href="images/favicon//manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/favicon//ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Site Title  -->
	<title>WGGT - WIND GREEN GAIN TOKEN</title>
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500,700" rel="stylesheet">
	<!-- Vendor Bundle CSS -->
	<link rel="stylesheet" href="assets/css/vendor.bundle.css?ver=132">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="assets/css/style.css?ver=132">
	<link rel="stylesheet" href="assets/css/theme.css?ver=132">
	
</head>

<body class="theme-light io-light-pro theme-muscari io-mascari" data-spy="scroll" data-target="#mainnav" data-offset="80">

    <div class="user-page d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="user-pro-box">
                       <div class="row">
                           <div class="col-md-4 text-center">
                               <div class="user-pro-info">
                                   <div class="user-logo">
                                        <a href=".">
                                            <img src="images/extra-pages/logo-sm-white.png"  srcset="images/extra-pages/logo-sm-white2x.png 2x" alt="icon">
                                        </a>
                                    </div>
                                    <div class="user-graphics">
                                        <img src="images/extra-pages/user-page-image.png" alt="user">
                                    </div>
                                    <div class="language-switcher dropup">
                                        <a href="#" data-toggle="dropdown">繁中</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">EN</a>
                                            <a class="dropdown-item" href="#">JP</a>
                                        </div>
                                    </div>
                               </div>
                           </div>
                           <div class="col-md-8">
                               <div class="user-pro-form">
                                   <nav>
                                      <div class="nav nav-tabs justify-content-center" id="nav-tab">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#cont-signup" >註冊</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#cont-signin">登入</a>
                                      </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active text-center" id="cont-signup" role="tabpanel">
					                        <span class="form-heading">請填入下列資訊註冊帳號:</span>
                                            <form action="login-signup.php" class="signup-form" method="post" action="#">
                                                <div class="input-item">
                                                    <input type="text" name="name" placeholder="您的姓名" class="input-border-simple" required>
                                                    <em class="fas fa-user"></em>
                                                </div>
                                                <div class="input-item">
                                                    <input type="text" name="email" placeholder="您的電子信箱" class="input-border-simple" required>
                                                    <em class="fas fa-envelope"></em>
                                                </div>
                                                <div class="row gutter-20">
                                                    <div class="col-lg-6">
                                                        <div class="input-item">
                                                            <input type="password" name="password" placeholder="設定密碼" class="input-border-simple" title="字母開頭，長度在6-18之間，只能包含字母和數字" pattern="^[a-zA-Z]\w{5,17}$" required>
                                                            <em class="fas fa-lock"></em>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="input-item">
                                                            <input type="password" name="password1" placeholder="再輸入一次密碼" class="input-border-simple" required>
                                                            <em class="fas fa-lock"></em>
                                                        </div>
                                                    </div>
                                                </div>
<?php
/*
?>
                                                <div class="input-item text-left">
                                                    <img src="images/gcaptcha-demo.jpg" width="50%;">
                                                </div>
<?php
*/
?>
                                                <div class="d-xl-flex justify-content-between align-items-center">
													<input type="hidden" name="memberReg" value="" />
                                                    <button class="btn btn-sm">確認送出</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="cont-signin" role="tabpanel">
                                            <span class="form-heading">請輸入您的帳號登入</span>
                                            <form action="login-signup.php" class="login-form" method="post" action="#">
                                                <div class="input-item">
                                                    <input type="text" name="email" placeholder="您的電子信箱" class="input-border-simple" required>
                                                    <em class="fas fa-user"></em>
                                                </div>
                                                <div class="input-item">
                                                    <input type="password" name="password" placeholder="您的登入密碼" class="input-border-simple" title="字母開頭，長度在6-18之間，只能包含字母和數字" pattern="^[a-zA-Z]\w{5,17}$" required>
                                                    <em class="fas fa-lock"></em>
                                                </div>
<?php
/*
?>
                                                <div class="input-item text-left">
                                                    <img src="images/gcaptcha-demo.jpg" width="50%;">
                                                </div>
<?php
*/
?>
												
												<input type="hidden" name="memberLogin" value="" />
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-sm">確認登入</button>
                                                    <a class="form-link" href="#">忘記密碼?</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="gaps"></div>
                    <div class="form-footer d-flex justify-content-between">
                       <span>Copyright &copy; 2018, Rich Star Group Co, Ltd. 版權所有 All Rights Reserved.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Preloader !remove please if you do not want -->
	<div id="preloader">
		<div id="loader"></div>
		<div class="loader-section loader-top"></div>
   		<div class="loader-section loader-bottom"></div>
	</div>
	<!-- Preloader End -->

	<!-- JavaScript (include all script here) -->
	<script src="assets/js/jquery.bundle.js?ver=132"></script>
	<script src="assets/js/script.js?ver=132"></script>

</body>
</html>
