<aside id="sidebar-wrapper">
	<div class="sidebar-brand">
		<a href="<?= base_url('admin'); ?>">PRESENSI KARYAWAN</a>
	</div>
	<div class="sidebar-brand sidebar-brand-sm">
		<a href="<?= base_url('admin'); ?>">PRS</a>
	</div>
	<ul class="sidebar-menu">
		<li class="<?= ($this->uri->segment(2) === "home" || $this->uri->segment(2) == "") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin'); ?>"><i class="fas fa-code"></i> <span>Dashboard</span></a></li>

		<li class="menu-header">Data Master</li>

		<li class="<?= ($this->uri->segment(2) === "jabatan") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/jabatan'); ?>"><i class="fa fa-boxes"></i> <span>Jabatan</span></a></li>
		<li class="<?= ($this->uri->segment(2) === "pegawai") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/pegawai'); ?>"><i class="fa fa-user"></i> <span>Pegawai</span></a></li>
		<li class="<?= ($this->uri->segment(2) === "setting") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/setting'); ?>"><i class="fa fa-wrench"></i> <span>Setting Presensi</span></a></li>

		<li class="menu-header">Data</li>

		<li class="<?= ($this->uri->segment(2) === "presensi") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/presensi'); ?>"><i class="fa fa-calendar"></i> <span>Presensi</span></a></li>
		<li class="<?= ($this->uri->segment(2) === "izin") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/izin'); ?>"><i class="fa fa-hand-paper"></i> <span>Rekap Izin</span></a></li>
		<li class="<?= ($this->uri->segment(2) === "lembur") ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url('admin/lembur'); ?>"><i class="fa fa-clock"></i> <span>Lembur</span></a></li>
	</ul>
</aside>