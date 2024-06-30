<x-app-layout>
@section('content')

<h1>Laporan Pinjaman</h1>

<form action="{{ route('result.laporanpinjaman') }}" method="GET">
        @csrf

        <div class="form-group mb-4">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
            <div class="invalid-feedback">
                Please select a valid start date.
            </div>
        </div>

        <div class="form-group mb-4">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
            <div class="invalid-feedback">
                Please select a valid end date.
            </div>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
    </form>


@endsection

</x-app-layout>