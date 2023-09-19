@extends('layouts.admin')
@section('title',$admin_page_title)
@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="block mb-0 pb-0">
                    <a class="btn btn-sm btn-primary" href="{{ route('cohorts.index') }}">Users</a>
                    <button type="submit" name="btn" value="saveAndClose" class="btn btn-primary btn-sm float-left mr-1" form="add-form">Save & Close</button>
                </div>
                <div class="block">
                    <div class="p-3 bg-white">

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
