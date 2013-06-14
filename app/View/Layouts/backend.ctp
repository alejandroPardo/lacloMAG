<?php

$cakeDescription = __d('LACLOmag', 'LACLO Magazine');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('app');

		echo $this->Html->script('library');
		echo $this->Html->script('migrateLibrary');
		echo $this->Html->script('app');
		echo $this->Html->script('initialize');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="content">
				<div id="header">
					<ul class="con">
						<li class="dashboard">
							<a href="#home">Dashboard</a>
						</li>
						<li class="count indicator">
							<span data-count="8">Notifications</span>
							<ul>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="messages">
							<span>Messages</span>
							<ul>
								<li class="unread">
									<a href="../img/demo/ajax.html" data-modal>
										<img class="avatar" src="../img/demo/avatar.jpg" alt="avatar" />
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<img class="avatar" src="../img/demo/boy_avatar.jpg" alt="avatar" />
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="../img/demo/ajax.html" data-modal>
										<img class="avatar" src="../img/demo/avatar92.jpg" alt="avatar" />
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="avatar">
							<img src="../img/demo/avatar.jpg" alt="avatar" />
							<ul>
								<li>
									<a href="#">
										<h4>Jacques Alba</h4>
										<p>Edit your profile</p>
									</a>
								</li>
								<li>
									<a href='<?php echo $this->Html->link(__('Sign Out'), array('action' => 'logout')); ?>'>
										<h4>Sign out</h4>
										<p>Leave the demo and return to the sign in screen</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="search">
							<input type="text" placeholder="Search" />
							<ul>
								<li>
									<a href="#">
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="#">
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
								<li>
									<a href="#">
										<h4>Jens Alba</h4>
										<p>Lorem ipsum dolor sit imet smd ddm lksdm lkdsm</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
