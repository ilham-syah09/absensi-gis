<aside id="sidebar-wrapper">
	<div class="sidebar-brand">
		<a href="<?= base_url('pegawai'); ?>">PRESENSI KARYAWAN</a>
	</div>
	<div class="sidebar-brand sidebar-brand-sm">
		<a href="<?= base_url('pegawai'); ?>">PRS</a>
	</div>
	<ul class="sidebar-menu">
		<li class="<?= ($this->uri->segment(2) === "home" || $this->uri->segment(2) == "") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('pegawai'); ?>"><i class="fas fa-code"></i> <span>Dashboard</span></a></li>

		<li class="menu-header">Data</li>

		<li class="<?= ($this->uri->segment(2) === "presensi") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('pegawai/presensi'); ?>"><i class="fa fa-calendar"></i> <span>Presensi</span></a></li>

		<li class="<?= ($this->uri->segment(2) === "profile") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('pegawai/profile'); ?>"><i class="fa fa-user"></i> <span>Profile</span></a></li>
	</ul>
</aside>