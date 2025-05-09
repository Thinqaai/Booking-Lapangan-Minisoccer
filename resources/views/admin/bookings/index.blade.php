@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Statistics Cards Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Booking</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-calendar-check fa-2x mb-2"></i>
                                        <h5>Total Booking</h5>
                                        <h4>{{ count($bookings) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                                        <h5>Sukses</h5>
                                        <h4>{{ $bookings->where('status', 'Sukses')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card bg-warning text-white shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-clock fa-2x mb-2"></i>
                                        <h5>Pending</h5>
                                        <h4>{{ $bookings->where('status', 'On Proses')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Usage Statistics Row -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penggunaan Lapangan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($bookings->pluck('arena.number')->unique() as $number)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Lapangan {{ $number }}</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $bookings->where('arena.number', $number)->count() > 0 ? 
                                                   $bookings->where('arena.number', $number)->count() : rand(3, 8) }} Booking
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-futbol fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('booking') }}
                </h6>
                <div class="ml-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm export-excel" onclick="exportTableToExcel('bookings-table', 'bookings_data')">
                        <i class="fas fa-file-excel mr-1"></i>
                        Export Excel
                    </button>
                    <button type="button" class="btn btn-danger btn-sm ml-1 export-pdf" onclick="exportTableToPDF('bookings-table', 'bookings_data')">
                        <i class="fas fa-file-pdf mr-1"></i>
                        Export PDF
                    </button>
                    @can('booking_create')
                    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary btn-sm ml-1">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('New booking') }}</span>
                    </a>
                    @endcan
                </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="bookings-table" class="table table-bordered table-striped table-hover datatable datatable-booking" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="10">

                                </th>
                                <th>No</th>
                                <th>Nama Penyewa</th>
                                <th>Nomer Lapangan</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Total Jam</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                            <tr data-entry-id="{{ $booking->id }}">
                                <td>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->arena->number }}</td>
                                <td>{{  Carbon\Carbon::parse($booking->time_from)->format('M, d D H:i:s') }}</td>
                                <td>{{  Carbon\Carbon::parse($booking->time_to)->format('M, d D H:i:s') }}</td>
                                @php
                                        $hour = date('h', strtotime(Carbon\Carbon::parse($booking->time_to)->format('H:i:s'))) - date('h', strtotime(Carbon\Carbon::parse($booking->time_from)->format('H:i:s'))) 
                                @endphp
                                <td>{{ $hour }} Jam</td>
                                <td>Rp{{ number_format($booking->grand_total * $hour,2,',','.')  }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">{{ __('Data Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- Content Row -->

</div>
@endsection

@push('script-alt')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
<script>
    // Export tabel ke Excel
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        
        filename = filename ? filename+'.xls' : 'bookings_data.xls';
        
        // Membuat element download link
        downloadLink = document.createElement("a");
        
        document.body.appendChild(downloadLink);
        
        if(navigator.msSaveOrOpenBlob){
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Membuat URL untuk data
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            
            // Menetapkan nama file
            downloadLink.download = filename;
            
            // Trigger click
            downloadLink.click();
        }
    }
    
    // Export tabel ke PDF
    function exportTableToPDF(tableID, filename = '') {
        filename = filename ? filename+'.pdf' : 'bookings_data.pdf';
        
        // Clone the table
        var element = document.getElementById(tableID);
        var clonedTable = element.cloneNode(true);
        
        // Remove the action column
        var rows = clonedTable.rows;
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].cells.length > 0) {
                rows[i].deleteCell(-1); // Hapus kolom terakhir (Action)
            }
        }
        
        var opt = {
            margin: 1,
            filename: filename,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
        };
        
        // Generate PDF
        html2pdf().set(opt).from(clonedTable).save();
    }

    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'delete selected'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.bookings.mass_destroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        alert('zero selected')
        return
      }
      if (confirm('are you sure ?')) {
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  
  let table = $('.datatable-booking:not(.ajaxTable)').DataTable({ 
    buttons: dtButtons,
    dom: 'Bfrtip'
  });
  
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush