<x-app-layout>
@section('content')

<h1>Laporan Pinjaman</h1>

<form action="{{ route('result.laporan') }}" method="GET">
        @csrf

        <div class="form-group mb-4">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="" selected disabled>Select Category...</option>
                <option value="1">Sembako</option>
                <option value="2">Kedelai</option>
                <option value="3">Tahu & Tempe</option>
            </select>
            <div class="invalid-feedback">
                Please select a valid category.
            </div>
        </div>

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