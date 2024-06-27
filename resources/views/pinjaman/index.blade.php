<x-app-layout>
    @section('content')
        <h1>Pinjaman List</h1>
        <a href="{{ route('pinjaman.bayar') }}" class="btn btn-primary">Bayar Pinjaman</a>
        <a href="{{ route('list.pinjaman.transaction') }}" class="btn btn-primary">Transaksi Pinjaman</a>

        <form method="POST" action="{{ route('pinjaman.store') }}">
            @csrf
            <div class="form-group">
                <label for="member_id">Member ID:</label>
                <select class="form-control" id="member_id" name="member_id" required>
                    <option value="">Select Member</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{ $member->nama_anggota }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_pinjaman">Jumlah Pinjaman:</label>
                <input type="text" class="form-control" id="jumlah_pinjaman" name="jumlah_pinjaman" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="tenor">Tenor:</label>
                <select class="form-control" id="tenor" name="tenor" required>
                    <option value="10">10</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total_bayar">Total Bayar:</label>
                <input type="text" class="form-control" id="total_bayar" name="total_bayar" readonly>
            </div>
            <div class="form-group">
                <label for="bayar_perbulan">Bayar Perbulan:</label>
                <input type="text" class="form-control" id="bayar_perbulan" name="bayar_perbulan" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        @if ($pinjamans->isEmpty())
            <p style="text-align: center;">No Pinjamans available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nama Anggota</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Start Date</th>
                        <th>Tenor</th>
                        <th>Total Bayar</th>
                        <th>Bayar Perbulan</th>
                        <th>Jumlah Sudah Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pinjamans as $pinjaman)
                        <tr>
                            <td>{{ $pinjaman->memberpinjaman->nama_anggota }}</td>
                            <td>{{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                            <td>{{ $pinjaman->start_date }}</td>
                            <td>{{ $pinjaman->tenor }}</td>
                            <td>{{ number_format($pinjaman->total_bayar, 0, ',', '.') }}</td>
                            <td>{{ number_format($pinjaman->bayar_perbulan, 0, ',', '.') }}</td>
                            <td>{{ $pinjaman->tenor_counter == null ? 'Belum ada pembayaran' : $pinjaman->tenor_counter }}
                            </td>
                            <td>{{ $pinjaman->is_lunas ? 'Lunas' : 'Belum Lunas' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <livewire:pinjaman-table />

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const jumlahPinjamanInput = document.getElementById('jumlah_pinjaman');
                const tenorSelect = document.getElementById('tenor');
                const totalBayarInput = document.getElementById('total_bayar');
                const bayarPerbulanInput = document.getElementById('bayar_perbulan');

                function formatRupiah(amount) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(amount);
                }

                function calculateValues() {
                    const jumlahPinjaman = parseFloat(jumlahPinjamanInput.value.replace(/[^,\d]/g, ''));
                    const tenor = parseInt(tenorSelect.value);

                    if (!isNaN(jumlahPinjaman) && !isNaN(tenor)) {
                        const totalBayar = jumlahPinjaman * 1.2; // Jumlah Pinjaman + 20%
                        const bayarPerbulan = totalBayar / tenor;

                        totalBayarInput.value = formatRupiah(totalBayar);
                        bayarPerbulanInput.value = formatRupiah(bayarPerbulan);
                    } else {
                        totalBayarInput.value = '';
                        bayarPerbulanInput.value = '';
                    }
                }

                jumlahPinjamanInput.addEventListener('input', function() {
                    const formattedValue = formatRupiah(parseFloat(this.value.replace(/[^,\d]/g, '')));
                    this.value = formattedValue;
                    calculateValues();
                });

                tenorSelect.addEventListener('change', calculateValues);
            });
        </script>
    @endsection
</x-app-layout>
