<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Input Data</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Input Data</h3>
                    <hr>
                </div>

                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('inputs.store') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>PartNumber</th>
                                        <th>Operations</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="date" name="Tanggal" id="from-datepicker"/>
                                        </td>
                                        <td>
                                            <select name="PartNumber" class="form-control">
                                                <option hidden>Choose</option>
                                                <option value="jjk123"> jjk123</option>
                                                <option value="best777">best777</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="Operations" id="operations-select" class="form-control">
                                                <option hidden>Choose</option>
                                                <option value="Produksi">Produksi</option>
                                                <option value="PM">PM</option>
                                                <option value="NOD">NOD</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="Quantity" id="quantity-input" class="form-control" min="0" step="1" value="0" disabled>
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

        <div class="row ">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3 class="text-center my-4">Data Input</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Part Number</th>
                                    <th>Operations</th>
                                    <th>Quantity</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($inputs as $input)
                                    <tr>
                                        <td>{{ $input->Tanggal }}</td>
                                        <td>{{ $input->PartNumber }}</td>
                                        <td>{{ $input->Operations }}</td>
                                        <td>{{ $input->Quantity }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('inputs.destroy', $input->id) }}" method="POST">
                                                @csrf
                                                <a href="#" class="btn btn-sm btn-primary edit-button" data-toggle="modal" data-target="#editModal-{{ $input->id }}" data-operations="{{ $input->Operations }}">Edit</a>
                                            </form>
                                            <form action="{{ route('inputs.destroy', $input->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @foreach($inputs as $input)
            <div class="modal fade" id="editModal-{{ $input->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editForm-{{ $input->id }}" method="POST" action="{{ route('inputs.update', ['input' => $input->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="editTanggal">Tanggal</label>
                                    <input type="date" name="Tanggal" class="form-control" id="editTanggal-{{ $input->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="editPartNumber">PartNumber</label>
                                    <select name="PartNumber" class="form-control" id="editPartNumber-{{ $input->id }}">
                                        <option value="jjk123">jjk123</option>
                                        <option value="best777">best777</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editOperations">Operations</label>
                                    <select name="Operations" class="form-control edit-operations-select" id="editOperations-{{ $input->id }}">
                                        <option value="Produksi">Produksi</option>
                                        <option value="PM">PM</option>
                                        <option value="NOD">NOD</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for "editQuantity">Quantity</label>
                                    <input type="number" class="form-control edit-quantity-input" name="Quantity" id="editQuantity-{{ $input->id }}" min="0" step="1" @if($input->Operations !== 'Produksi') disabled @endif value="{{ $input->Operations === 'Produksi' ? $input->Quantity : '' }}">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-edit-button" data-inputid="{{ $input->id }}">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#editModal-{{ $input->id }}').on('show.bs.modal', function (event) {
                        var modal = $(this);
                        var selectedOperations = modal.find("#editOperations-{{ $input->id }}").val();
                        var quantityInput = modal.find("#editQuantity-{{ $input->id }}");

                        if (selectedOperations !== "Produksi") {
                            quantityInput.prop("disabled", true);
                        } else {
                            quantityInput.prop("disabled", false);
                            quantityInput.val("");
                        }
                    });
                });
            </script>
        @endforeach
    </div>

    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script type="text/javascript">


        $(document).ready(function() {
            $("#from-datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });
        });

        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-center",
        };

        $(".edit-button").on("click", function() {
            var inputId = $(this).data("inputid");
            var modalId = "#editModal-" + inputId;
            var editForm = $(modalId).find("form");
            var selectedOperations = editForm.find("#editOperations-" + inputId).val();
            var quantityInput = editForm.find("#editQuantity-" + inputId);

            editForm.find("#editOperations-" + inputId).val(selectedOperations);

            if (selectedOperations !== "Produksi") {
                quantityInput.prop("disabled", true);
            } else {
                quantityInput.prop("disabled", false);
                quantityInput.val("");
            }

            $(modalId).modal("show");
        });

        $('#editModal-{{ $input->id }}').on('show.bs.modal', function (event) {
    var modal = $(this);
    var selectedOperations = modal.find("#editOperations-{{ $input->id }}").val();
    var quantityInput = modal.find("#editQuantity-{{ $input->id }}");

    if (selectedOperations !== "Produksi") {
        quantityInput.prop("disabled", true);
    } else {
        quantityInput.prop("disabled", false);
        quantityInput.val("");
    }
});

        $(document).on("change", ".edit-operations-select", function() {
    var selectedOperation = $(this).val();
    var quantityInput = $(this).closest("form").find(".edit-quantity-input");

    if (selectedOperation !== "Produksi") {
        quantityInput.prop("disabled", true);
    } else {
        quantityInput.prop("disabled", false);
        quantityInput.val("");
    }
});
$(".save-edit-button").on("click", function() {
    var inputId = $(this).data("inputid");
    var editForm = $("#editForm-" + inputId);
    var formData = editForm.serialize();

    $.ajax({
        type: 'POST',
        url: editForm.attr('action'),
        data: formData,
        success: function(response) {
            var modalId = "#editModal-" + inputId;
            $(modalId).modal("hide");

            // Reload data after a successful edit
            location.reloadData();

            // Show the toast message
            var toast = $('.toast');
            toast.toast('show');
        },
        error: function(xhr) {
            var errors = xhr.responseJSON;
        }
    });
});
        $("#operations-select").on("change", function() {
            var selectedOperation = $(this).val();
            var quantityInput = $("#quantity-input");
            if (selectedOperation === "Produksi") {
                quantityInput.prop("disabled", false);
            } else {
                quantityInput.prop("disabled", true);
            }
        });
    </script>
</body>
</html>
