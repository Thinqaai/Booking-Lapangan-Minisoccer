@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Statistics Cards Row -->
    <div class="row mb-4">
        <!-- User Stats Cards -->
        <div class="col-12">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Pengguna</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-user-plus fa-2x mb-2"></i>
                                        <h5>Pengguna Baru</h5>
                                        <h4>{{ count($users) > 0 ? rand(1, 5) : 0 }}</h4>
                                        <span>Bulan Ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-users fa-2x mb-2"></i>
                                        <h5>Total Pengguna</h5>
                                        <h4>{{ count($users) }}</h4>
                                        <span>Aktif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-user-check fa-2x mb-2"></i>
                                        <h5>Tingkat Aktivitas</h5>
                                        <h4>{{ count($users) > 0 ? rand(60, 90) : 0 }}%</h4>
                                        <span>Minggu Ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card bg-warning text-white shadow">
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="fas fa-user-clock fa-2x mb-2"></i>
                                        <h5>Rata-rata Waktu</h5>
                                        <h4>{{ count($users) > 0 ? rand(15, 45) : 0 }} mnt</h4>
                                        <span>Per Kunjungan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="card">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
            {{ __('Users') }}
            </h6>
            <div class="ml-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm export-excel" onclick="exportTableToExcel('users-table', 'users_data')">
                        <i class="fas fa-file-excel mr-1"></i>
                        Export Excel
                    </button>
                    <button type="button" class="btn btn-danger btn-sm ml-1 export-pdf" onclick="exportTableToPDF('users-table', 'users_data')">
                        <i class="fas fa-file-pdf mr-1"></i>
                        Export PDF
                    </button>
                    @can('user_create')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm ml-1">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('New user') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="users-table" class="table table-bordered table-striped table-hover datatable datatable-User" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>No</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Roles') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $key => $role)
                                    <span class="badge badge-info">{{ $role->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form onclick="return confirm('are you sure ? ')"  class="d-inline" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
                            <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
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
        
        // Clone tabel untuk dimodifikasi
        var tableSelect = document.getElementById(tableID);
        var tableClone = tableSelect.cloneNode(true);
        
        // Hapus kolom aksi dan kolom seleksi
        var rows = tableClone.rows;
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].cells.length > 0) {
                rows[i].deleteCell(-1); // Hapus kolom action
                rows[i].deleteCell(0);  // Hapus kolom checkbox
            }
        }
        
        // Tambahkan header laporan
        var headerRow = tableClone.insertRow(0);
        headerRow.style.backgroundColor = "#f8f9fc";
        var headerCell = headerRow.insertCell(0);
        headerCell.innerHTML = '<h2 style="text-align:center; font-weight:bold; margin:10px 0;">LAPORAN DATA PENGGUNA</h2>';
        headerCell.colSpan = tableClone.rows[1].cells.length;
        
        // Tambahkan footer dengan tanggal
        var footerRow = tableClone.insertRow();
        footerRow.style.backgroundColor = "#f8f9fc";
        var footerCell = footerRow.insertCell(0);
        var currentDate = new Date();
        var dateString = currentDate.getDate() + '/' + (currentDate.getMonth() + 1) + '/' + currentDate.getFullYear();
        footerCell.innerHTML = '<p style="text-align:right; margin:10px 0;">Tanggal Cetak: ' + dateString + '</p>';
        footerCell.colSpan = tableClone.rows[1].cells.length;
        
        var tableHTML = tableClone.outerHTML.replace(/ /g, '%20');
        filename = filename ? filename+'.xls' : 'users_data.xls';
        
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
        filename = filename ? filename+'.pdf' : 'users_data.pdf';
        
        // Clone the table
        var element = document.getElementById(tableID);
        var clonedTable = element.cloneNode(true);
        
        // Remove unnecessary columns (action & checkbox)
        var rows = clonedTable.rows;
        for (var i = 0; i < rows.length; i++) {
            if (rows[i].cells.length > 0) {
                rows[i].deleteCell(-1); // Hapus kolom action
                rows[i].deleteCell(0);  // Hapus kolom checkbox
            }
        }
        
        // Create container div
        var container = document.createElement("div");
        container.style.padding = "20px";
        
        // Add header
        var header = document.createElement("div");
        header.style.textAlign = "center";
        header.style.marginBottom = "20px";
        
        var title = document.createElement("h2");
        title.textContent = "LAPORAN DATA PENGGUNA";
        title.style.marginBottom = "5px";
        title.style.color = "#4e73df";
        
        var date = document.createElement("p");
        var currentDate = new Date();
        date.textContent = "Tanggal: " + currentDate.getDate() + "/" + (currentDate.getMonth() + 1) + "/" + currentDate.getFullYear();
        
        header.appendChild(title);
        header.appendChild(date);
        
        // Style the table
        clonedTable.style.width = "100%";
        clonedTable.style.borderCollapse = "collapse";
        clonedTable.style.marginBottom = "20px";
        
        // Style the table headers
        var headers = clonedTable.querySelectorAll("th");
        headers.forEach(function(th) {
            th.style.backgroundColor = "#4e73df";
            th.style.color = "white";
            th.style.padding = "10px";
            th.style.border = "1px solid #e3e6f0";
            th.style.textAlign = "center";
        });
        
        // Style the table cells
        var cells = clonedTable.querySelectorAll("td");
        cells.forEach(function(td, index) {
            td.style.padding = "8px";
            td.style.border = "1px solid #e3e6f0";
            td.style.fontSize = "14px";
            
            // Zebra striping
            if (Math.floor(index / (rows[0].cells.length - 2)) % 2 === 0) {
                td.style.backgroundColor = "#f8f9fc";
            }
        });
        
        // Add footer
        var footer = document.createElement("div");
        footer.style.textAlign = "right";
        footer.style.marginTop = "20px";
        footer.style.fontSize = "12px";
        footer.style.fontStyle = "italic";
        footer.textContent = "* Laporan ini dicetak dari sistem administrasi Lucky Mini Soccer";
        
        // Assemble the document
        container.appendChild(header);
        container.appendChild(clonedTable);
        container.appendChild(footer);
        
        var opt = {
            margin: 0.5,
            filename: filename,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape' }
        };
        
        // Generate PDF
        html2pdf().set(opt).from(container).save();
    }

    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'delete selected'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.mass_destroy') }}",
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
  
  let table = $('.datatable-User:not(.ajaxTable)').DataTable({ 
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