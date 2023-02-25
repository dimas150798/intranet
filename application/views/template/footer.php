<footer class="py-4 bg-light mt-auto" id="footer">
	<div class="container-fluid px-4">
		<div class="d-flex align-items-center justify-content-center small">
			<div>Copyright &copy; My Infly Networks 2022</div>

		</div>
	</div>
</footer>
</div>
</div>

<!-- JS dataTables -->
<!-- <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js">
</script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap5.min.js">
</script> -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/af-2.5.1/r-2.4.0/datatables.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>assets/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url(); ?>assets/demo/chart-bar-demo.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
<!-- <script src="<?php echo base_url(); ?>assets/js/datatables-simple-demo.js">
-->
</script>

<!-- JS Website -->
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js">
</script>
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-multiple').select2();
	});
</script>

<script type="text/javascript">
	$('#datatablesSimple').DataTable({
		responsive: true,
		autoFill: true,
		pagingType: 'simple',
	});
</script>

<!-- loading Screen-->
<script type="text/javascript">
	$(document).ready(function() {

		setTimeout(function() {
			$('#ctn-preloader').addClass('loaded');
			// Una vez haya terminado el preloader aparezca el scroll
			$('body').removeClass('no-scroll-y');

			if ($('#ctn-preloader').hasClass('loaded')) {
				// Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
				$('#preloader').delay(1000).queue(function() {
					$(this).remove();
				});
			}
		}, 3000);

	});
</script>

<!-- AOS -->
<script src="<?php echo base_url(); ?>assets/js/aos.js"></script>

<!-- AOS -->
<script>
	AOS.init({
		easing: 'ease-in-out-sine'
	});
</script>

<script>
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

	// Close the dropdown if the user clicks outside of it
	window.onclick = function(event) {
		if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('show')) {
					openDropdown.classList.remove('show');
				}
			}
		}
	}
</script>

<!-- Button Search  -->
<script type="text/javascript">
	$('#kota').each(function() {
		$(this).select2({
			placeholder: 'Pilih Kota',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#kecamatan').each(function() {
		$(this).select2({
			placeholder: 'Pilih Kecamatan',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#kelurahan').each(function() {
		$(this).select2({
			placeholder: 'Pilih Kelurahan',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#dataCustomer').each(function() {
		$(this).select2({
			placeholder: 'Pilih Customer',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#pegawai').each(function() {
		$(this).select2({
			placeholder: 'Pilih Pegawai',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#barang').each(function() {
		$(this).select2({
			placeholder: 'Pilih Barang',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#satuan').each(function() {
		$(this).select2({
			placeholder: 'Pilih Satuan',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#kategori').each(function() {
		$(this).select2({
			placeholder: 'Pilih kategori',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#status').each(function() {
		$(this).select2({
			placeholder: 'Pilih status',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#keadaan').each(function() {
		$(this).select2({
			placeholder: 'Pilih Keadaan Barang',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#kodeBarang').each(function() {
		$(this).select2({
			placeholder: 'Pilih SN Modem',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});
	$('#pendidikan').each(function() {
		$(this).select2({
			placeholder: 'Pilih Pendidikan',
			theme: 'bootstrap-5',
			dropdownParent: $(this).parent(),
		});
	});


	// Select Function 
	$(document).ready(function() {
		$('#kota').on('change', function() {
			var id_kota = $(this).val();

			if (id_kota == '') {
				$('#kecamatan').prop('disabled', true);
			} else {
				$('#kecamatan').prop('disabled', false);
				$.ajax({
					url: "<?php echo base_url('admin/DataCustomer/AddCustomerPusat/getKecamatan') ?>",
					type: "POST",
					data: {
						'id_kota': id_kota
					},
					dataType: 'json',
					success: function(data) {
						$('#kecamatan').html(data);
					},
					error: function() {
						alert('Error..');
					}

				});
			}
		});

		$('#kecamatan').on('change', function() {
			var id_kecamatan = $(this).val();

			if (id_kecamatan == '') {
				$('#kelurahan').prop('disabled', true);
			} else {
				$('#kelurahan').prop('disabled', false);
				$.ajax({
					url: "<?php echo base_url('admin/DataCustomer/AddCustomerPusat/getKelurahan') ?>",
					type: "POST",
					data: {
						'id_kecamatan': id_kecamatan
					},
					dataType: 'json',
					success: function(data) {
						$('#kelurahan').html(data);
					},
					error: function() {
						alert('Error..');
					}

				});
			}
		});

	});
</script>

</body>

</html>