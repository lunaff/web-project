@extends('dashboard.master')
@section('title', 'Calendar')

@section('nav')
    @include('dashboard.header')
    @include('dashboard.nav')
@endsection

@section('page', 'Calendar')

@section('main')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <button class="btn btn-primary w-100" id="btn-new-event"><i class="mdi mdi-plus"></i> Create New Schedule</button>
                                    {{-- <div id="external-events">
                                        <br>
                                        <div class="external-event fc-event bg-success" data-class="bg-success">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New Event Planning
                                        </div>
                                        <div class="external-event fc-event bg-info" data-class="bg-info">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                                        </div>
                                        <div class="external-event fc-event bg-warning" data-class="bg-warning">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating Reports
                                        </div>
                                        <div class="external-event fc-event bg-danger" data-class="bg-danger">
                                            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create New theme
                                        </div>
                                    </div> --}}
                                    <div class="row justify-content-center mt-5">
                                        <img src="assets/images/calendar-img.png" alt="" class="img-fluid d-block">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col-->

                        <div class="col-xl-9">
                            <div class="card card-h-100">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div> 
                    </div> 

                    <div style='clear:both'></div>

                    <div class="col-sm-3" id="success-alert">
                        <div class="alert alert-success alert-dismissible fade"  role="alert" style="display: none;">
                            <i class="mdi mdi-check-all d-block display-4 mt-2 mb-3 text-success"></i>
                            <h5 class="text-success">Success</h5>
                            <p id="alert-message">Data has been saved successfully!</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                        
                    <!-- Add New Event MODAL -->
                    <div class="modal fade" id="event-modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header py-3 px-4 border-bottom-0">
                                    <h5 class="modal-title" id="modal-title">Event</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <form class="needs-validation" name="event-form" id="form-event" novalidate method="POST">
                                        @csrf
                                        <div class="row">
                                            <!-- Event Name -->
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Event Name</label>
                                                    <input class="form-control" placeholder="Insert Event Name"
                                                        type="text" name="title" id="event-title" required />
                                                    <div class="invalid-feedback">Please provide a valid event name</div>
                                                </div>
                                            </div>
                    
                                            <!-- Start Date & Time -->
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Start Date & Time</label>
                                                    <input class="form-control" type="datetime-local" name="start" id="event-start" required />
                                                    <div class="invalid-feedback">Please select a valid start date & time</div>
                                                </div>
                                            </div>
                    
                                            <!-- End Date & Time (Optional) -->
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">End Date & Time (Optional)</label>
                                                    <input class="form-control" type="datetime-local" name="end" id="event-end" />
                                                </div>
                                            </div>
                    
                                            <!-- Category -->
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi Lengkap</label>
                                                    <input class="form-control" type="text" name="category" id="event-category"/>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger" id="btn-delete-event">Delete</button>
                                            </div>
                                            <div class="col-6 text-end">
                                                <button type="button" class="btn btn-light me-1" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" id="btn-save-event">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> <!-- end modal-content-->
                        </div> <!-- end modal dialog-->
                    </div>
                    <!-- end modal-->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@endsection

@section('script')
<script src="assets/libs/fullcalendar/index.global.min.js"></script>

<!-- Calendar init -->
{{-- <script src="assets/js/pages/calendar.init.js"></script> --}}

<script src="assets/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btn-new-event').click(function() {
            $('#event-modal').modal('show'); 
        });

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            editable: true,
            selectable: true,
            events: @json($events),

            dateClick: function(info) {
                $('#event-modal').modal('show');
                $('#event-title').val('');
                $('#event-category').val('');
                $('#event-start').val(info.dateStr);
                $('#event-end').val('');
            },

            eventDrop: function(info) {
                $.ajax({
                    url: "/calendar/update/" + info.event.id,
                    type: "PUT",
                    data: {
                        start: info.event.start.toISOString(),
                        end: info.event.end ? info.event.end.toISOString() : null,
                        category: info.event.className[0],
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        calendar.refetchEvents();
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            },

            eventClick: function(info) {
                $('#event-title').val(info.event.title);
                $('#event-category').val(info.event.classNames[0]);
                $('#event-start').val(info.event.startStr);
                $('#event-end').val(info.event.endStr ? info.event.endStr : '');
                $('#event-modal').modal('show');

                $('#btn-delete-event').off('click').on('click', function() {
                    if (confirm("Delete this event?")) {
                        $.ajax({
                            url: "/calendar/destroy/" + info.event.id,
                            type: "DELETE",
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                if (response.success) {
                                    alert(response.message);
                                    calendar.refetchEvents();
                                    $('#event-modal').modal('hide');
                                } else {
                                    alert("Failed to delete event.");
                                }
                            },
                            error: function(xhr) {
                                alert("Error: " + xhr.responseText);
                            }
                        });
                    }
                });
            }
        });

        calendar.render();

        // Handle form submit untuk menyimpan event baru
        $('#form-event').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit default

            let title = $('#event-title').val();
            let start = $('#event-start').val();
            let end = $('#event-end').val();
            let category = $('#event-category').val();

            $.ajax({
                url: "{{ route('calendar.store') }}",
                type: "POST",
                data: {
                    title: title,
                    start: start,
                    end: end,
                    category: category,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('#alert-message').text(response.message); // Set pesan alert
                        calendar.refetchEvents(); // Refresh kalender
                        $('#success-alert').fadeIn(); // Tampilkan alert
                        $('#event-modal').modal('hide'); // Tutup modal
                    } 
                },
                error: function(xhr) {
                    alert("Error: " + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection