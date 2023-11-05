<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Input</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Edit Data Input</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('inputs.update', $input->id) }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                            <input type="date" name="Tanggal" id="from-datepicker" value="{{ $input->Tanggal }}">
                                        </td>
                                        <td>
                                            {{-- <input type="text" name="PartNumber" class="form-control" value="{{ $input->PartNumber }}"> --}}
                                            <select name="PartNumber" class="form-control">
                                                <option value="jjk123" {{ $input->PartNumber === 'jjk123' ? 'selected' : '' }}>jjk123</option>
                                                <option value="best777" {{ $input->PartNumber === 'best777' ? 'selected' : '' }}>best777</option>
                                            </select>
                                        </td>
                                        <td>
                                            {{-- <input type="text" name="Operations" class="form-control" value="{{ $input->Operations }}"> --}}
                                            <select name="Operations" id="operations-select" class="form-control">
                                                <option value="Produksi" {{ $input->Operations === 'Produksi' ? 'selected' : '' }}>Produksi</option>
                                                <option value="PM" {{ $input->Operations === 'PM' ? 'selected' : '' }}>PM</option>
                                                <option value="NOD" {{ $input->Operations === 'NOD' ? 'selected' : '' }}>NOD</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="Quantity" class="form-control" min="0" step="1" value="{{ $input->Quantity }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">


    <script>
        $( document ).ready(function() {
            $("#from-datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });
            $("#from-datepicker").on("change", function () {
                var fromdate = $(this).val();
                alert(fromdate);
            });
            $("#datepicker").datepicker(pickerOpts);
        });
        </script>
    </script>
</body>
</html>


