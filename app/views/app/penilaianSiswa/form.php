<form action="<?= $data['action'] ?>" method="post" id="form-submit">
    <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-lg-4">Mata Pelajaran</label>
            <div class="col-lg-8">
                <select name="matapelajaran_id" class="form-control select2" id="">
                    <option value=""> -- Mata Pelajaran --</option>
                    <?php
                    $selectedMPelajaran = isset($data['row']) ? $data['row']['matapelajaran_id'] ?? '' : '';
                    foreach ($data['mataPelajaran'] as $key => $item) { ?>
                        <option value="<?= $item['id']  ?>" <?= $selectedMPelajaran == $item['id'] ? 'selected' : '' ?>><?= $item['nama_matapelajaran'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Nilai</label>
            <div class="col-lg-8">
                <input type="number" name="value_nilai" placeholder="Nilai..." class="form-control" value="<?= isset($data['row']) ? $data['row']['value_nilai'] ?? '' : '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-lg-4">Keterangan</label>
            <div class="col-lg-8">
                <textarea name="keterangan_nilai" class="form-control" placeholder="Keterangan..." id="" rows="5"><?= isset($data['row']) ? $data['row']['keterangan_nilai'] ?? '' : '' ?></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fa-solid fa-x"></i> Batal
        </button>
        <button type="submit" class="btn btn-primary" id="btn-submit">
            <i class="fa-regular fa-paper-plane"></i> Submit
        </button>
    </div>
</form>
<script src="<?= BASEURL ?>/public/js/app/penilaianSiswa/form.js"></script>