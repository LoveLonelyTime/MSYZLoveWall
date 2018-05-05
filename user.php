<?php
session_start();
include "setting/database.php";
function getUserByID($id){
	return mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id = $id"));
}
function isUserExistByUsername($username){
	return mysql_num_rows(mysql_query("SELECT * FROM user WHERE username = '$username'")) != 0;
}
function getUserByUsername($username){
	return mysql_fetch_array(mysql_query("SELECT * FROM user WHERE username = '$username'"));
}
function outputUserCenter($id){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		mysql_query("SET time_zone = '+8:00'");
		$result = mysql_query("SELECT * FROM user WHERE id = $id");
		if(mysql_num_rows($result)!=0){
			$row = mysql_fetch_array($result);
			$username = $row["username"];
			$header = $row["header"];
			$signature = $row["signature"];
			$sex = $row["sex"];
			$QQ = $row["QQ"];
			$grade = $row["grade"];
			$class = $row["class"];
			$real_name = $row["real_name"];
?>
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-auto">
		<a href="javascript:showChangeHeaderModal()"><img src=<?php echo $header; ?> alt="Header" class="border" id="headerImage" width="150" height="150" data-toggle="tooltip" data-placement="top" title="点击更换头像"/></a>
		</div>
		<div class="col">
			<h3>
			<?php
			echo $username;
			if($sex == 0){
			?>
			<a href="javascript:showChangeSexModal()" data-toggle="tooltip" data-placement="top" title="点击修改性别"><i class="fas fa-venus-mars text-muted"></i></a>
			<?php
			}else if($sex == 1){
			?>	
			<a href="javascript:showChangeSexModal()" data-toggle="tooltip" data-placement="top" title="点击修改性别"><i class="fas fa-mars text-primary"></i></a>
			<?php
			}else if($sex == 2){
			?>	
			<a href="javascript:showChangeSexModal()" data-toggle="tooltip" data-placement="top" title="点击修改性别"><i class="fas fa-venus text-danger"></i></a>
			<?php
			}
			?>
			</h3>
			<h6 class="text-muted">
			<a href="javascript:showChangeValueModal('个性签名','doChangeSignature()')" data-toggle="tooltip" data-placement="right" title="点击修改个性签名" class="text-muted">
			<?php
			if(!empty($signature)){
				echo $signature;
			}else{
				echo "这个人很懒，什么都没留下";
			}
			?>
			</a>
			</h6>
		</div>
	</div>
	<div id="tabs" class="mt-3">
		<ul>
			<li><a href="#information">个人资料</a></li>
			<li><a href="#publish">表白TA</a></li>
			<li><a href="#metion">被TA表白</a></li>
		</ul>
		<div id="information">
			<p>
				<div>
					<h6><i class="fas fa-tag text-success"></i> QQ号 <a href="javascript:showChangeValueModal('QQ号','doChangeQQ()')"><i class="fas fa-pencil-alt text-primary"></i></a></h6>
					<span class="pl-3"><?php echo $QQ; ?></span>
				</div>
				<div>
					<h6><i class="fas fa-tag text-success"></i> 年级 <a href="javascript:showChangeGradeModal()"><i class="fas fa-pencil-alt text-primary"></i></a></h6>
					<span class="pl-3">
					<?php
					if($grade == 0){
					?>
					保密
					<?php
					}else if($grade == 1){
					?>
					高一
					<?php
					}else if($grade == 2){
					?>
					高二
					<?php	
					}else if($grade == 3){
					?>
					高三
					<?php	
					}
					?>
					</span>
				</div>
				<div>
					<h6><i class="fas fa-tag text-success"></i> 班级 <a href="javascript:showChangeClassModal()"><i class="fas fa-pencil-alt text-primary"></i></a></h6>
					<span class="pl-3">
					<?php
					if($class == 0){
					?>
					保密
					<?php	
					}else{
						echo $class."班";
					}
					?>
					</span>
				</div>
				<div>
					<h6><i class="fas fa-tag text-success"></i> 真实姓名 <a href="javascript:showChangeValueModal('真实姓名','doChangeRealName()')"><i class="fas fa-pencil-alt text-primary"></i></a></h6>
					<span class="pl-3">
					<?php
					if(empty($real_name)){
					?>
					保密
					<?php	
					}else{
						echo $real_name;
					}
					?>
					</span>
				</div>
			</p>
		</div>
		<div id="publish">
			<p>
				<?php
				$love_note_result = mysql_query("SELECT * FROM love_note WHERE user_id = $id ORDER BY date DESC");
				while($love_note_row = mysql_fetch_array($love_note_result)){
				?>
				<div class="my-3 p-3 bg-light rounded box-shadow">
				<h6 class="border-bottom border-gray pb-2 mb-0">
					<div class="row">
						<div class="col">
							<?php
							if(!empty($love_note_row["user_id"])){
								$user = getUserByID($love_note_row["user_id"]);
							?>
							<a href="/user.php?id=<?php echo $user["id"]; ?>">
								<img src="<?php echo $user["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $user["username"]; ?></span>
							</a>
							<?php
							}else{
							?>
							<img src="/img/anonymous_header.jpg" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span>匿名用户</span>
							<?php
							}
							?>
							<i class="fas fa-heartbeat text-danger"></i>
							<?php
							if(substr($love_note_row["object"], 0, 1) == "@"){
								if(isUserExistByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1))){
									$object = getUserByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1));
							?>
							<a href="/user.php?id=<?php echo $object["id"]; ?>">
								<img src="<?php echo $object["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $object["username"]; ?></span>
							</a>
							<?php
								}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
								}
							}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
							}
							?>
						</div>
						<div class="col">
							<div class="text-right text-muted"><?php echo $love_note_row["date"]; ?></div>
						</div>
					</div>
				</h6>
				<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
					<?php echo $love_note_row["content"]; ?>
				</div>
				<div class="media-body pb-3 mb-0 small lh-125">
					<?php
					$comment_id = $love_note_row["id"];
					$comment_love_note_result = mysql_query("SELECT love_note_comment.user_id,love_note_comment.content,user.username,user.header FROM love_note_comment LEFT JOIN user ON user.id = love_note_comment.user_id WHERE love_note_comment.love_note_id = $comment_id");
					while($comment_row = mysql_fetch_array($comment_love_note_result)){
					?>
					<div class="mt-1">
						<a href="/user.php?id=<?php echo $comment_row["user_id"]; ?>">
							<img src="<?php echo $comment_row["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span><?php echo $comment_row["username"]; ?></span>
						</a>
						<span>：<?php echo $comment_row["content"]; ?></span>
					</div>
					<?php
					}
					?>
				</div>
			</div>
				<?php
				}
				?>
			</p>
		</div>
		<div id="metion">
			<p>
				<?php
				$love_note_result = mysql_query("SELECT * FROM love_note WHERE object = '@$username' ORDER BY date DESC");
				while($love_note_row = mysql_fetch_array($love_note_result)){
				?>
				<div class="my-3 p-3 bg-light rounded box-shadow">
				<h6 class="border-bottom border-gray pb-2 mb-0">
					<div class="row">
						<div class="col">
							<?php
							if(!empty($love_note_row["user_id"])){
								$user = getUserByID($love_note_row["user_id"]);
							?>
							<a href="/user.php?id=<?php echo $user["id"]; ?>">
								<img src="<?php echo $user["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $user["username"]; ?></span>
							</a>
							<?php
							}else{
							?>
							<img src="/img/anonymous_header.jpg" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span>匿名用户</span>
							<?php
							}
							?>
							<i class="fas fa-heartbeat text-danger"></i>
							<?php
							if(substr($love_note_row["object"], 0, 1) == "@"){
								if(isUserExistByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1))){
									$object = getUserByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1));
							?>
							<a href="/user.php?id=<?php echo $object["id"]; ?>">
								<img src="<?php echo $object["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $object["username"]; ?></span>
							</a>
							<?php
								}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
								}
							}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
							}
							?>
						</div>
						<div class="col">
							<div class="text-right text-muted"><?php echo $love_note_row["date"]; ?></div>
						</div>
					</div>
				</h6>
				<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
					<?php echo $love_note_row["content"]; ?>
				</div>
				<div class="media-body pb-3 mb-0 small lh-125">
					<?php
					$comment_id = $love_note_row["id"];
					$comment_love_note_result = mysql_query("SELECT love_note_comment.user_id,love_note_comment.content,user.username,user.header FROM love_note_comment LEFT JOIN user ON user.id = love_note_comment.user_id WHERE love_note_comment.love_note_id = $comment_id");
					while($comment_row = mysql_fetch_array($comment_love_note_result)){
					?>
					<div class="mt-1">
						<a href="/user.php?id=<?php echo $comment_row["user_id"]; ?>">
							<img src="<?php echo $comment_row["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span><?php echo $comment_row["username"]; ?></span>
						</a>
						<span>：<?php echo $comment_row["content"]; ?></span>
					</div>
					<?php
					}
					?>
				</div>
			</div>
				<?php
				}
				?>
			</p>
		</div>
	</div>
</div>
<?php
		}else{
?>
<h1 class="text-center">没有id为<?php echo $id; ?>的用户</h1>
<?php
		}
	}
	mysql_close($connection);
}
function outputUser($id){
	$connection = mysql_connect(DATABASE_SERVER_NAME,DATABASE_USERNAME,DATABASE_PASSWORD);
	if($connection){
		mysql_set_charset('utf8');
		mysql_select_db(DATABASE_NAME, $connection);
		mysql_query("SET time_zone = '+8:00'");
		$result = mysql_query("SELECT * FROM user WHERE id = $id");
		if(mysql_num_rows($result)!=0){
			$row = mysql_fetch_array($result);
			$username = $row["username"];
			$header = $row["header"];
			$signature = $row["signature"];
			$sex = $row["sex"];
			$QQ = $row["QQ"];
			$grade = $row["grade"];
			$class = $row["class"];
			$real_name = $row["real_name"];
?>
<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="row">
		<div class="col-auto">
			<img src=<?php echo $header; ?> alt="Header" class="border" id="headerImage" width="150" height="150"/>
		</div>
		<div class="col">
			<h3>
			<?php
			echo $username;
			if($sex == 0){
			?>
			<i class="fas fa-venus-mars text-muted"></i>
			<?php
			}else if($sex == 1){
			?>	
			<i class="fas fa-mars text-primary"></i>
			<?php
			}else if($sex == 2){
			?>	
			<i class="fas fa-venus text-danger"></i>
			<?php
			}
			?>
			</h3>
			<h6 class="text-muted">
			<?php 
			if(!empty($signature)){
				echo $signature;
			}else{
				echo "这个人很懒，什么都没留下";
			}
			?>
			</h6>
		</div>
	</div>
	<div id="tabs" class="mt-3">
		<ul>
			<li><a href="#information">个人资料</a></li>
			<li><a href="#publish">表白TA</a></li>
			<li><a href="#metion">被TA表白</a></li>
		</ul>
		<div id="information">
			<p>
				<div>
					<h6><i class="fas fa-tag text-success"></i> QQ号</h6>
					<span class="pl-3"><?php echo $QQ; ?></span>
				</div>
				<div>
					<h6><i class="fas fa-tag text-success"></i> 年级</h6>
					<span class="pl-3">
					<?php
					if($grade == 0){
					?>
					保密
					<?php
					}else if($grade == 1){
					?>
					高一
					<?php
					}else if($grade == 2){
					?>
					高二
					<?php	
					}else if($grade == 3){
					?>
					高三
					<?php	
					}
					?>
					</span>
				</div>
				<div>
					<h6><i class="fas fa-tag text-success"></i> 班级</h6>
					<span class="pl-3">
					<?php
					if($class == 0){
					?>
					保密
					<?php	
					}else{
						echo $class."班";
					}
					?>
					</span>
				</div>
				<div>
					<h6><i class="fas fa-tag text-success"></i> 真实姓名</h6>
					<span class="pl-3">
					<?php
					if(empty($real_name)){
					?>
					保密
					<?php	
					}else{
						echo $real_name;
					}
					?>
					</span>
				</div>
			</p>
		</div>
		<div id="publish">
			<p>
				<?php
				$love_note_result = mysql_query("SELECT * FROM love_note WHERE user_id = $id ORDER BY date DESC");
				while($love_note_row = mysql_fetch_array($love_note_result)){
				?>
				<div class="my-3 p-3 bg-light rounded box-shadow">
				<h6 class="border-bottom border-gray pb-2 mb-0">
					<div class="row">
						<div class="col">
							<?php
							if(!empty($love_note_row["user_id"])){
								$user = getUserByID($love_note_row["user_id"]);
							?>
							<a href="/user.php?id=<?php echo $user["id"]; ?>">
								<img src="<?php echo $user["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $user["username"]; ?></span>
							</a>
							<?php
							}else{
							?>
							<img src="/img/anonymous_header.jpg" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span>匿名用户</span>
							<?php
							}
							?>
							<i class="fas fa-heartbeat text-danger"></i>
							<?php
							if(substr($love_note_row["object"], 0, 1) == "@"){
								if(isUserExistByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1))){
									$object = getUserByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1));
							?>
							<a href="/user.php?id=<?php echo $object["id"]; ?>">
								<img src="<?php echo $object["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $object["username"]; ?></span>
							</a>
							<?php
								}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
								}
							}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
							}
							?>
						</div>
						<div class="col">
							<div class="text-right text-muted"><?php echo $love_note_row["date"]; ?></div>
						</div>
					</div>
				</h6>
				<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
					<?php echo $love_note_row["content"]; ?>
				</div>
				<div class="media-body pb-3 mb-0 small lh-125">
					<?php
					$comment_id = $love_note_row["id"];
					$comment_love_note_result = mysql_query("SELECT love_note_comment.user_id,love_note_comment.content,user.username,user.header FROM love_note_comment LEFT JOIN user ON user.id = love_note_comment.user_id WHERE love_note_comment.love_note_id = $comment_id");
					while($comment_row = mysql_fetch_array($comment_love_note_result)){
					?>
					<div class="mt-1">
						<a href="/user.php?id=<?php echo $comment_row["user_id"]; ?>">
							<img src="<?php echo $comment_row["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span><?php echo $comment_row["username"]; ?></span>
						</a>
						<span>：<?php echo $comment_row["content"]; ?></span>
					</div>
					<?php
					}
					?>
				</div>
			</div>
				<?php
				}
				?>
			</p>
		</div>
		<div id="metion">
			<p>
				<?php
				$love_note_result = mysql_query("SELECT * FROM love_note WHERE object = '@$username' ORDER BY date DESC");
				while($love_note_row = mysql_fetch_array($love_note_result)){
				?>
				<div class="my-3 p-3 bg-light rounded box-shadow">
				<h6 class="border-bottom border-gray pb-2 mb-0">
					<div class="row">
						<div class="col">
							<?php
							if(!empty($love_note_row["user_id"])){
								$user = getUserByID($love_note_row["user_id"]);
							?>
							<a href="/user.php?id=<?php echo $user["id"]; ?>">
								<img src="<?php echo $user["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $user["username"]; ?></span>
							</a>
							<?php
							}else{
							?>
							<img src="/img/anonymous_header.jpg" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span>匿名用户</span>
							<?php
							}
							?>
							<i class="fas fa-heartbeat text-danger"></i>
							<?php
							if(substr($love_note_row["object"], 0, 1) == "@"){
								if(isUserExistByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1))){
									$object = getUserByUsername(substr($love_note_row["object"],1, strlen($love_note_row["object"])-1));
							?>
							<a href="/user.php?id=<?php echo $object["id"]; ?>">
								<img src="<?php echo $object["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
								<span><?php echo $object["username"]; ?></span>
							</a>
							<?php
								}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
								}
							}else{
							?>
							<span><?php echo $love_note_row["object"]; ?></span>
							<?php
							}
							?>
						</div>
						<div class="col">
							<div class="text-right text-muted"><?php echo $love_note_row["date"]; ?></div>
						</div>
					</div>
				</h6>
				<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
					<?php echo $love_note_row["content"]; ?>
				</div>
				<div class="media-body pb-3 mb-0 small lh-125">
					<?php
					$comment_id = $love_note_row["id"];
					$comment_love_note_result = mysql_query("SELECT love_note_comment.user_id,love_note_comment.content,user.username,user.header FROM love_note_comment LEFT JOIN user ON user.id = love_note_comment.user_id WHERE love_note_comment.love_note_id = $comment_id");
					while($comment_row = mysql_fetch_array($comment_love_note_result)){
					?>
					<div class="mt-1">
						<a href="/user.php?id=<?php echo $comment_row["user_id"]; ?>">
							<img src="<?php echo $comment_row["header"]; ?>" alt="Header" class="rounded-circle" width="30" height="30"/>
							<span><?php echo $comment_row["username"]; ?></span>
						</a>
						<span>：<?php echo $comment_row["content"]; ?></span>
					</div>
					<?php
					}
					?>
				</div>
			</div>
				<?php
				}
				?>
			</p>
		</div>
	</div>
</div>
<?php
		}else{
?>
<h1 class="text-center">没有id为<?php echo $id; ?>的用户</h1>
<?php
		}
	}
	mysql_close($connection);
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<link rel="shortcut icon" href=" /favicon.ico"/>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
		<!-- JQuery UI CSS -->
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
		<!-- User CSS -->
		<link rel="stylesheet" href="/css/user.css"/>
		<!-- Baidu -->
		<?php include "template/baidu.html"; ?>
		<!-- Google AD -->
		<?php include "template/google.html"; ?>
		<title>密山一中表白墙 用户中心</title>
	</head>
	<body class="bg-light">
		<?php
		include "template/header.php";
		?>
		<main class="container">
		<?php
		if(!empty($_GET["id"])){
			if(isset($_SESSION["user"]) && $_SESSION["user"] === $_GET["id"]){
				outputUserCenter($_SESSION["user"]);
			}else{
				outputUser($_GET["id"]);
			}
		}else{
			if(isset($_SESSION["user"])){
				outputUserCenter($_SESSION["user"]);
			}else{
		?>
		<h1 class="text-center">你没有指定用户id</h1>
		<?php
			}
		}
		?>
		</main>
		<?php
		include "template/footer.html";
		?>
		<div class="modal fade" id="changeHeaderModal" tabindex="-1" role="dialog" aria-labelledby="changeHeaderModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="changeHeaderModalTitle">更换头像</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="upload-file"/>
								<label class="custom-file-label" for="upload-file">选择图片</label>
							</div>
						</form>
						<img src="/img/default_image.png" alt="showHeader" width="250" height="250" class="border" style="display:none;" id="showHeaderImg"/>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" onclick="doChangeHeader()">更换</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="changeSexModal" tabindex="-1" role="dialog" aria-labelledby="changeSexModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="changeSexModalTitle">更换性别</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<select class="custom-select" id="sexSelect">
								<option value="0" selected>保密</option>
								<option value="1">男</option>
								<option value="2">女</option>
							</select>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" onclick="doChangeSex()">更换</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="changeValueModal" tabindex="-1" role="dialog" aria-labelledby="changeValueModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="changeValueModalTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<input type="text" class="form-control" id="valueInput"/>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" id="valueButton">更换</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="changeGradeModal" tabindex="-1" role="dialog" aria-labelledby="changeGradeModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="changeGradeModalTitle">更换年级</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<select class="custom-select" id="gradeSelect">
								<option value="0" selected>保密</option>
								<option value="1">高一</option>
								<option value="2">高二</option>
								<option value="3">高三</option>
							</select>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" onclick="doChangeGrade()">更换</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="changeClassModal" tabindex="-1" role="dialog" aria-labelledby="changeClassModalTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="changeClassModalTitle">更换班级</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form>
							<select class="custom-select" id="classSelect">
								<option value="0" selected>保密</option>
								<option value="1">1班</option>
								<option value="2">2班</option>
								<option value="3">3班</option>
								<option value="4">4班</option>
								<option value="5">5班</option>
								<option value="6">6班</option>
								<option value="7">7班</option>
								<option value="8">8班</option>
								<option value="9">9班</option>
								<option value="10">10班</option>
								<option value="11">11班</option>
								<option value="12">12班</option>
								<option value="13">13班</option>
								<option value="14">14班</option>
								<option value="15">15班</option>
								<option value="16">16班</option>
								<option value="17">17班</option>
								<option value="18">18班</option>
								<option value="19">19班</option>
								<option value="20">20班</option>
							</select>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
						<button type="button" class="btn btn-primary" onclick="doChangeClass()">更换</button>
					</div>
				</div>
			</div>
		</div>
		<!-- JQuery JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- Popper JavaScript -->
		<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<!-- JQuery UI JavaScript -->
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
		<!-- Module JavaScript -->
		<script src="/js/module.js"></script>
		<!-- Uploader JavaScript -->
		<script src="/js/uploader.js"></script>
		<!-- User JavaScript -->
		<script src="/js/user.js"></script>
		<!-- Font Awesome JavaScript -->
		<script src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>