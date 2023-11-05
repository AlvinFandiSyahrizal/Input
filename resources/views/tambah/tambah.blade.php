<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Tambah Data</h3>
                    <hr>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('tambahs.store') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>PartNumber</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="PartNumber" class="form-control">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="text-center my-4">Data Input</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Part Number</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tambahs as $tambah)
                                <tr>
                                    <td>{{ $tambah->PartNumber }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('tambahs.destroy', $tambah->id) }}" method="POST">
                                            @csrf
                                            <a href="#" class="btn btn-sm btn-primary edit-button" data-toggle="modal" data-target="#editModal" data-partnumber="{{ $tambah->PartNumber }}" data-tambahid="{{ $tambah->id }}">Edit</a>
                                        </form>
                                        <form action="{{ route('tambahs.destroy', $tambah->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ route('tambahs.update', ['tambah' => $tambah->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editPartNumber">PartNumber</label>
                            <input type="text" name="PartNumber" class="form-control" id="editPartNumber">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success save-edit-button">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>


<script>
    $(document).ready(function() {
        $(".edit-button").on("click", function() {
            var partNumberValue = $(this).data("partnumber");
            var tambahId = $(this).data("tambahid");
            $("#editPartNumber").val(partNumberValue);
            $("#editForm").attr("action", actionUrl);
            $("#editModal").modal("show");
        });

        $(".save-edit-button").on("click", function() {
            var editForm = $("#editForm");
            var formData = editForm.serialize();
            $.ajax({
                type: 'POST',
                url: editForm.attr('action'),
                data: formData,
                success: function(response) {
                    $("#editModal").modal("hide");
                    location.reload();
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON;
                }
            });
        });
    });
    </script>
