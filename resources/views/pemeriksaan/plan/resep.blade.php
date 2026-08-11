<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Obat
        </label>

        <select name="id_obat" class="form-select">
        <option value="">Pilih Obat</option>
    @foreach($obats as $obat)
        <option value="{{ $obat->id_obat }}">
            {{ $obat->nama_obat }}
            - {{ $obat->stok_obat }}
        </option>
        </option>
    @endforeach
        </select>

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">
            Jumlah
        </label>

        <input
            type="number"
            class="form-control">

    </div>

    <div class="col-md-3 mb-3">

        <label class="form-label">
            Measure
        </label>

        <select class="form-select">

            <option>Tablet</option>
            <option>Kapsul</option>
            <option>SDM</option>
            <option>SDT</option>

        </select>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <label class="form-label">

            Dosis

        </label>

        <select class="form-select">

            <option>1x sehari</option>
            <option>2x sehari</option>
            <option>3x sehari</option>

        </select>

    </div>

</div>