@extends('layouts.app')

@section('content')
    <div class="container">
        <table id="prijave-tabela" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="10%">Id prijave</th>
                    <th width="10%">Zakazano u</th>
                    <th width="20%">Pacijent</th>
                    <th width="20%">Doktor</th>
                    <th width="15%">Ustanova</th>
                    <th width="15%">Vakcina</th>
                    <th width="10%">Akcija</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            loadDataTable();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function loadDataTable() {
                $('#prijave-tabela').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "http://127.0.0.1:8000/api/prijave/datatable"
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'zakazano_u',
                            name: 'zakazano_u'
                        },
                        {
                            data: 'pacijent.name',
                            name: 'pacijent',
                        },
                        {
                            data: 'doktor.name',
                            name: 'doktor',
                            defaultContent: '<b>Nije dodeljen</b>',
                            render: function(data, type, row, meta) {
                                if (!data) {
                                    return `<button id=${row['id']}  class="btn btn-primary btn-sm upd"> Nepostoji, dodeli sebi </button>`;
                                } else return data;
                            }
                        },
                        {
                            data: 'ustanova.naziv_ustanova',
                            name: 'ustanova'
                        },
                        {
                            data: 'vakcina.proizvodjac',
                            name: 'vakcina'
                        },
                        {
                            data: 'id',
                            name: 'id',
                            render: function(data) {
                                return `<button type="button" name="" id="${data}" class="del btn btn-danger btn-lg btn-block">
                                    Obrisi
                                </button>`
                            }
                        }
                    ]
                })
            }

        });

        $('body').on('click', '.del', function(e) {
            const id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/prijave/" + id,
                data: {
                    _method: 'DELETE'
                },
                success: function(response) {
                    alert(response.poruka)
                    $('#prijave-tabela').DataTable().ajax.reload();
                }
            });
        });

        $('body').on('click', '.upd', function(e) {
            const id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/prijave/" + id + "/update",
                data: {
                    _method: 'PUT'
                },
                success: function(response) {
                    alert(response.poruka);
                    $('#prijave-tabela').DataTable().ajax.reload();

                }
            });
        });
    </script>
@endsection
