<x-app-layout>
    @section('content')

    <h1>bayar Pinjaman</h1>

    <form action="{{ route('pinjaman.bayarproses') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="pinjaman_id">Choose Member:</label>
                <select name="pinjaman_id" id="pinjaman_id" class="form-control">
                    @foreach($pinjamans->where('is_lunas', 0) as $pinjaman)
                        <option value="{{ $pinjaman->id }}" data-bayar-perbulan="{{ $pinjaman->bayar_perbulan }}">{{ $pinjaman->memberpinjaman->nama_anggota }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="bayar">Bayar (Rp):</label>
                <input type="text" name="bayar" id="bayar" class="form-control" placeholder="Enter amount in Rp">
                
            </div>

            <div class="form-group">
                <label for="remark">Remark:</label>
                <textarea name="remark" id="remark" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Process Payment</button>
        </form>
        <script>

        document.getElementById('pinjaman_id').addEventListener('change', function () {
                    var selectedOption = this.options[this.selectedIndex];
                    var bayarPerbulan = selectedOption.getAttribute('data-bayar-perbulan');
                    console.log('ini berapa : ', bayarPerbulan);
                    document.getElementById('bayar').value = bayarPerbulan ? 'Rp ' + bayarPerbulan : '';
                });
        // Function to format input as Indonesian Rupiah
        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp ' + rupiah;
        }

        // On input change, format the input value
        document.getElementById('bayar').addEventListener('input', function (e) {
            var input = e.target.value;
            e.target.value = formatRupiah(input);
        });
    </script>

    @endsection

   
</x-app-layout>