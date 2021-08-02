	<!-- MODAL -->
	<div class="modal fade" id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 text="center" class="modal-title" style="margin-left: 9em;" id="exampleModalLongTitle">Profil Anda</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <img src="img/gd.jpg" style="width: 40%; margin-bottom: 20px;">
            <p>Username : <?= $_SESSION['user']; ?></p>
            <p>- Created by Hisiv -</p>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          </div>
        </div>
      </div>
    </div>
	
	<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tekan Tidak Untuk Kembali</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Apakah kamu yakin ingin keluar ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-dark text-white" data-dismiss="modal"><i class="fa fa-times mr-2" aria-hidden="true"></i>Tidak</button>
					<a href="<?= BASE_URL; ?>/logout"><button type="button" class="btn btn-danger text-white"><i class="fa fa-sign-out mr-2" aria-hidden="true"></i>Keluar</button></a>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="SubmitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tekan Tidak Untuk Kembali</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Data akan ditambahkan pada Stok Barang, Apakah anda yakin akan menyimpan data ?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-dark text-white" data-dismiss="modal"><i class="fa fa-times mr-2" aria-hidden="true"></i>Tidak
					</button>
					<button type="Submit" class="btn btn-warning text-white"><i class="fa fa-floppy-o mr-2" aria-hidden="true"></i>Tambah
					</button>
				</div>
			</div>
		</div>
	</div>

	
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script type="text/javascript" src="<?= BASE_URL; ?>/js/bootstrap.js"></script>    
	<script type="text/javascript" src="<?= BASE_URL; ?>/js/script.js"></script>
</body>
</html>