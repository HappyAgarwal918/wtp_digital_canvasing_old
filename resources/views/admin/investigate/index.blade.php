@extends('layouts.admin')
@section('title',$admin_page_title)
@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="block mb-0 pb-0">
                    <a class="btn btn-sm btn-primary" href="{{ route('cohorts.create') }}">New</a>
                </div>
                <div class="block">
                    <table class="table table-sm table-bordered">
                        {{-- <tr>
                            <th>User Name</th>
                            <th class="text-center">State</th>
                            <th class="text-center">Access</th>
                            <th class="text-center">Inactive</th>
                            <th></th>
                        </tr>
                        @foreach ( $items as $value)
                            <tr>
                                <td>{{ $value->username }}</td>
                                <td class="text-center">{{ $value->state }}</td>
                                <td class="text-center">{{ $value->user_label }}</td>
                                <td class="text-center">{{ $value->inactive ? 'Yes' : 'No' }}</td>
                                <td><a href="{{ route('users.edit', $value->id) }}" class="btn btn-sm btn-light"><i class="fas fa-search"></i></a></td>
                            </tr>
                        @endforeach --}}
                    </table>
                    {{-- {{ $items->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@endsection
