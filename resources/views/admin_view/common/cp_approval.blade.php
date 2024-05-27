@extends('admin_view.layout.app') 
@section('title') 
Admin - CP Approval
@endsection 

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Hoverable Table</h4>
            <p class="card-description">Add class <code>.table-hover</code></p>

            @if (session()->has('error'))
              <p class="mb-0 alert alert-danger">{{ session()->get('error') }}</p>
            @endif
            @if (session()->has('success'))
              <p class="mb-0 alert alert-success">{{ session()->get('success') }}</p>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Whatsapp</th>
                            <th>Gender</th>
                            <th>Home Town</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Post</th>
                            <th>Presenter</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cp_approvals as $cp_approval)
                        <form action="{{ route('update_cp_aprroval') }}" method="POST">
                            @csrf
                            <tr>
                                <td>{{ $cp_approval->name }}</td>
                                <td><a href="tel:{{ $cp_approval->phone }}">{{ $cp_approval->phone }}</a></td>
                                <td><a href="mailto:{{ $cp_approval->email }}">{{ $cp_approval->email }}</a></td>
                                <td><a href="{{ $cp_approval->whatsapp }}">{{ $cp_approval->whatsapp }}</a></td>
                                <td>
                                    @if ($cp_approval->gender == 'm')
                                        Male
                                    @elseif ($cp_approval->gender == 'm')
                                        Female
                                        @else
                                        Other
                                    @endif
                                </td>
                                <td>{{ $cp_approval->home_town }}</td>
                                <td>{{ $cp_approval->city }}</td>
                                <td>{{ $cp_approval->country }}</td>
                                <td>
                                    @foreach ($roles as $role)
                                        @if ($cp_approval->role_id == $role->role_id)
                                            {{ $role->role_name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <select name="presenter_id" id="" class="form-control">
                                        <option value="">Choose..</option>
                                        @foreach ($all_presenters as $all_presenter)
                                           <option value="{{ $all_presenter->admin_id }}">{{ $all_presenter->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" hidden name="member_id" value="{{ $cp_approval->member_id }}">
                                    <input type="submit" class="btn btn-success" value="Approve">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal">
                                        Delete
                                    </button>
                                </td>
                                {{-- <td class="text-danger">28.76% <i class="mdi mdi-arrow-down"></i></td>
                                <td><label class="badge badge-danger">Pending</label></td> --}}
                            </tr>
                            <script>
                                $('#myModal').on('shown.bs.modal', function () {
                                    $('#myInput').trigger('focus')
                                })
                            </script>
                            <div id="rejectModal" class="modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Delete Member</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p>This member will be permanently deleted..</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="btn btn-danger" href="{{ route('delete_member', ['member_id'=>$cp_approval->member_id]) }}">Delete</a>
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

