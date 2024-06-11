<div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                <a href="{{ route('member.list') }}" class="btn btn-secondary btn-lg">View Members</a>
                    <div class="card-header text-center bg-gradient-primary text-white h4 py-3">Add New Member</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('members.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="form-group mb-4">
                                <label for="nama_anggota" class="form-label">Nama Anggota</label>
                                <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" required>
                                <div class="invalid-feedback">
                                    Please enter a valid name.
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="alamat_anggota" class="form-label">Alamat Anggota</label>
                                <input type="text" class="form-control" id="alamat_anggota" name="alamat_anggota" required>
                                <div class="invalid-feedback">
                                    Please enter a valid address.
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="handphone" class="form-label">Handphone</label>
                                <input type="text" class="form-control" id="handphone" name="handphone" required>
                                <div class="invalid-feedback">
                                    Please enter a valid phone number.
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="tipe_member" class="form-label">Tipe Member</label>
                                <select class="form-select" id="tipe_member" name="tipe_member" required>
                                    <option value="" selected disabled>Select Tipe Member...</option>
                                    <option value="Anggota tetap">Anggota Tetap</option>
                                    <option value="Anggota tidak tetap">Anggota Tidak Tetap</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a member type.
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label">Keanggotaan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_penabung" name="is_penabung">
                                    <label class="form-check-label" for="is_penabung">Penabung</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_peminjam" name="is_peminjam">
                                    <label class="form-check-label" for="is_peminjam">Peminjam</label>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container {
            max-width: 800px;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
        }

        .card-header {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background: linear-gradient(45deg, #007bff, #0056b3);
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .form-select {
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s;
        }

        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check-label {
            margin-left: 8px;
        }

        .form-group {
            position: relative;
            margin-bottom: 2rem;
        }

        .form-label {
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #495057;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875rem;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback,
        .was-validated .form-select:invalid ~ .invalid-feedback {
            display: block;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1.125rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
    </style>

    <script>
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>