<?php
// Ambil hak akses pengguna dari sesi
$username = $this->session->userdata('username');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
	<div class="container-na">
		<div class="navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown user">
					<a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="<?= base_url('assets/master/img/profile-admin.png') ?>" alt="Profile-Admin"
							class="avatar img-fluid rounded-circle mr-1">
						<?= $username ?> </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<div class="dropdown-menu-body">
							<a href="<?= base_url('user/logout') ?>" class="dropdown-item text-muted">
								Sign out
							</a>
						</div>
					</div>
				</li>
			</ul>

		</div>
	</div>
</nav>