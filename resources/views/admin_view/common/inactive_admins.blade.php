@extends('admin_view.layout.app') 
@section('title') 
Admin - Inactive Admins 
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

            <input type="datetime-local" id="startTimestamp">
            <input type="datetime-local" id="endTimestamp">
            <button id="filterButton">Filter</button>
            
            <div class="table-responsive">
                <table id="filterTableAdmin" class="table table-hover table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Whatsapp</th>
                            <th>User Code</th>
                            <th>Gender</th>
                            <th>Home Town</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Balance</th>
                            <th>Withdraws</th>
                            <th>Added By</th>
                            <th>Post</th>
                            @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)
                                <th>Status</th>
                            @endif
                            <th>Joined At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                        @endphp
                        @foreach ($inactive_admins as $inactive_admin)
                            @if ($inactive_admin->email != 'pritomguha62@gmail.com')
                                @if ($inactive_admin->email != 'holy.it01@gmail.com')
                                    <form action="{{ route('update_admin') }}" method="POST">
                                        @csrf
                                        <tr>
                                            <td>{{ $sl }}</td>
                                            <td>{{ $inactive_admin->name }}</td>
                                            <td><a href="tel:{{ $inactive_admin->phone }}">{{ $inactive_admin->phone }}</a></td>
                                            <td><a href="mailto:{{ $inactive_admin->email }}">{{ $inactive_admin->email }}</a></td>
                                            <td><a href="https://wa.me/{{ $inactive_admin->whatsapp }}">{{ $inactive_admin->whatsapp }}</a></td>
                                            <td>{{ $inactive_admin->user_code }}</td>
                                            <td>
                                                @if ($inactive_admin->gender == 'm')
                                                    Male
                                                @elseif ($inactive_admin->gender == 'f')
                                                    Female
                                                    @else
                                                    Other
                                                @endif
                                            </td>
                                            <td>{{ $inactive_admin->home_town }}</td>
                                            <td>{{ $inactive_admin->city }}</td>
                                            <td>{{ $inactive_admin->country }}</td>
                                            <td>{{ $inactive_admin->balance }}</td>
                                            <td>{{ $inactive_admin->withdraws }}</td>
                                            <td>
                                                @foreach ($all_admins as $all_admin)
                                                    @if ($inactive_admin->parent_id == $all_admin->admin_id)
                                                        {{ $all_admin->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($roles as $role)
                                                    @if ($inactive_admin->role_id == $role->role_id)
                                                        {{ $role->role_title }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            @if (session()->get('role_id') == 1 or session()->get('role_id') == 2)
                                                <td>
                                                    @if ($inactive_admin->role_id != 1)
                                                        @if ($inactive_admin->role_id != session()->get('role_id'))
                                                            <select name="status">
                                                                @if ($inactive_admin->status == 1)
                                                                    <option value="1">Active</option>
                                                                @else
                                                                <option value="0">Inactive</option>
                                                                @endif
                                                                <option value="0">Inactive</option>
                                                                <option value="1">Active</option>
                                                            </select>
                                                        @endif
                                                    @endif
                                                </td>
                                            @endif
                                            <td>
                                                {{-- @php
                                                    $create_date_time = explode(' ', $inactive_admin->created_at);
                                                @endphp
                                                <input type="date" value="{{ $create_date_time[0] }}" disabled>
                                                <input type="time" value="{{ $create_date_time[1] }}" disabled> --}}
                                                {{ $inactive_admin->created_at }}
                                            </td>
                                            <td>
                                                <input type="hidden" hidden name="admin_id" value="{{ $inactive_admin->admin_id }}">
                                                <input type="submit" class="btn btn-success" value="Update">
                                            </td>
                                            {{-- <td class="text-danger">28.76% <i class="mdi mdi-arrow-down"></i></td>
                                            <td><label class="badge badge-danger">Pending</label></td> --}}
                                        </tr>
                                    </form>
                                    @php
                                        $sl++;
                                    @endphp
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


{{-- 
<script>
    $(document).ready(function() {
        $('#inactive_admins').DataTable();
    });
</script> --}}


@endsection


