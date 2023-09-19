@extends('layouts.admin')
@section('title',$admin_page_title)
@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="block mb-0 pb-0">
                    <a class="btn btn-sm btn-dark" href="{{ route('cohorts.index') }}">Close</a>
                    <button type="submit" name="btn" value="save" class="btn btn-success btn-sm float-left mr-1" form="add-form">Save</button>
                    <button type="submit" name="btn" value="saveAndClose" class="btn btn-primary btn-sm float-left mr-1" form="add-form">Save & Close</button>
                </div>
                <div class="block">
                    <div class="p-3 bg-white">
                        <form action="{{ route('cohorts.store') }}" method="post" enctype="multipart/form-data" id="add-form">
                            @csrf
                            <div class="row pb-3">
                                 <div class="col-md-3">
                                    <select class="selectpicker" name="cohorts_id" id="cohorts_id" title="Select Cohort">
                                        @foreach ($cohorts as $value)
                                        <option value="{{ $value->id }}">{{ $value->election_number }} {{ $value->user_description }}</option>
                                        @endforeach
                                        <option value="new">New: New Cohort</option>
                                    </select>
                                 </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@endsection
