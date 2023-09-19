@extends('layouts.admin')
@section('title',$admin_page_title)
@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="block mb-0 pb-0">
                    <a class="btn btn-sm btn-primary" href="{{ route('users.index') }}">Users</a>
                    <button type="submit" name="btn" value="saveAndClose" class="btn btn-primary btn-sm float-left mr-1" form="add-form">Save & Close</button>
                </div>
                <div class="block">
                    <div class="p-3 bg-white">
                        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" id="add-form">
                            @csrf
                            <div class="row pb-3">
                                <div class="col-md-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-sm {{ $errors->has('first_name') ? 'is-invalid' : '' }}" value="{{ old('first_name') }}">
                                    {{-- @if($errors->has('first_name'))
                                    <small class="form-text text-danger">{{ $errors->first('first_name') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-1">
                                    <label for="middle_initial">MI</label>
                                    <input type="text" name="middle_initial" id="middle_initial" class="form-control form-control-sm {{ $errors->has('middle_initial') ? 'is-invalid' : '' }}" value="{{ old('middle_initial') }}" maxlength="2">
                                    {{-- @if($errors->has('middle_initial'))
                                    <small class="form-text text-danger">{{ $errors->first('middle_initial') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-3">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control form-control-sm {{ $errors->has('last_name') ? 'is-invalid' : '' }}" value="{{ old('last_name') }}">
                                    {{-- @if($errors->has('last_name'))
                                    <small class="form-text text-danger">{{ $errors->first('last_name') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-1 px-0">
                                    <label for="gender">Sex</label>
                                    <select name="gender" id="gender" data-width="100%" class="form-control form-control-sm selectpicker {{ $errors->has('gender') ? 'is-invalid' : '' }}" title="Select">
                                        @php($selectedItem = old('gender'))
                                        <option value="m" {{ $selectedItem == 'm' ? 'selected' : null }}>M</option>
                                        <option value="f" {{ $selectedItem == 'f' ? 'selected' : null }}>F</option>
                                    </select>
                                    {{-- @if($errors->has('gender'))
                                    <small class="form-text text-danger">{{ $errors->first('gender') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-2">
                                    <label for="birthday">Birthday</label>
                                    <input type="text" name="birthday" id="birthday" placeholder="mm/dd/yy" class="form-control form-control-sm datepicker {{ $errors->has('birthday') ? 'is-invalid' : null}}" value="{{ old('birthday') }}" autocomplete="off">
                                    {{-- @if($errors->has('birthday'))
                                    <small class="form-text text-danger">{!! $errors->first('birthday') !!}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-2">
                                    <label for="last_4_ssn">Last 4 SSN</label>
                                    <input type="number" oninput="maxLengthCheck(this)" name="last_4_ssn" id="last_4_ssn" class="form-control form-control-sm {{ $errors->has('last_4_ssn') ? 'is-invalid' : '' }}" value="{{ old('last_4_ssn') }}" maxlength="4">
                                    {{-- @if($errors->has('last_4_ssn'))
                                    <small class="form-text text-danger">{{ $errors->first('last_4_ssn') }}</small>
                                    @endif --}}
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-5">
                                    <label for="street_address">Street Address</label>
                                    <input type="text" name="street_address" id="street_address" class="form-control form-control-sm {{ $errors->has('street_address') ? 'is-invalid' : '' }}" value="{{ old('street_address') }}">
                                    {{-- @if($errors->has('street_address'))
                                    <small class="form-text text-danger">{{ $errors->first('street_address') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-3">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" class="form-control form-control-sm {{ $errors->has('city') ? 'is-invalid' : '' }}" value="{{ old('city') }}">
                                    {{-- @if($errors->has('city'))
                                    <small class="form-text text-danger">{{ $errors->first('city') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-1 px-0">
                                    <label for="state">state</label>
                                    <input type="text" name="state" id="state" class="form-control form-control-sm {{ $errors->has('state') ? 'is-invalid' : '' }}" value="AZ">
                                    {{-- @if($errors->has('state'))
                                    <small class="form-text text-danger">{{ $errors->first('state') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-3">
                                    <label for="zipcode">Zipcode</label>
                                    <input type="number" name="zipcode" id="zipcode" class="form-control form-control-sm {{ $errors->has('zipcode') ? 'is-invalid' : '' }}" value="{{ old('zipcode') }}" maxlength="5" oninput="maxLengthCheck(this)">
                                    {{-- @if($errors->has('zipcode'))
                                    <small class="form-text text-danger">{{ $errors->first('zipcode') }}</small>
                                    @endif --}}
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-4">
                                    <label for="phone">Phone</label>
                                    <div class="input-group">
                                        <input type="tel" name="phone" id="phone" class="form-control form-control-sm {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone') }}">
                                    </div>
                                    {{-- @if($errors->has('phone'))
                                    <small class="form-text text-danger">{{ $errors->first('phone') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-5">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm email {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                                    {{-- @if($errors->has('email'))
                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-3">
                                    <label for="voter_id">VoterID</label>
                                    <input type="number" name="voter_id" id="voter_id" class="form-control form-control-sm {{ $errors->has('voter_id') ? 'is-invalid' : '' }}" value="{{ old('voter_id') }}" maxlength="7" oninput="maxLengthCheck(this)">
                                    {{-- @if($errors->has('voter_id'))
                                    <small class="form-text text-danger">{{ $errors->first('voter_id') }}</small>
                                    @endif --}}
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-3">
                                    <label for="approved_by_id">Approved By</label>
                                    <select name="approved_by_id" id="approved_by_id" data-width="100%" class="form-control form-control-sm selectpicker {{ $errors->has('approved_by_id')? 'is-invalid' : '' }}" title="Select approved by">
                                        @php($selectedItem = old('approved_by_id'))
                                        @foreach ($approved_users as $value)
                                        <option value="{{ $value->id }}" {{ $value->id ==  $selectedItem ? 'selected' : ''}}>{{ $value->first_name.' '.$value->last_name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- @if($errors->has('approved_by_id'))
                                    <small class="form-text text-danger">{{ $errors->first('approved_by_id') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-3">
                                    <label for="manager_id">Manager</label>
                                    <select name="manager_id" id="manager_id" data-width="100%" class="form-control form-control-sm selectpicker {{ $errors->has('manager_id')? 'is-invalid' : '' }}" title="Select manager">
                                        @php($selectedItem = old('manager_id'))
                                        @foreach ($managers as $value)
                                        <option value="{{ $value->id }}" {{ $value->id ==  $selectedItem ? 'selected' : ''}}>{{ $value->first_name.' '.$value->last_name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- @if($errors->has('manager_id'))
                                    <small class="form-text text-danger">{{ $errors->first('manager_id') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-sm {{ $errors->has('username') ? 'is-invalid' : '' }}" value="{{ old('username') }}">
                                    {{-- @if($errors->has('username'))
                                    <small class="form-text text-danger">{{ $errors->first('username') }}</small>
                                    @endif --}}
                                </div>
                                <div class="col-md-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-sm {{ $errors->has('password') ? 'is-invalid' : '' }}" value="{{ old('password') }}">
                                    @if($errors->has('password'))
                                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-9">
                                    <div class="row">
                                        @foreach ( $access_labels as $value)
                                        <div class="col-md-5">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="user_label[{{ $value->id }}]" class="custom-control-input" id="user_label_{{ $value->id }}" value="{{ $value->value }}">
                                                <label class="custom-control-label" for="user_label_{{ $value->id }}">{{ $value->title }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="user_label">Access</label>
                                        {{-- name="user_label" --}}
                                        <input class="form-control form-control-sm" value="{{ old('user_label') }}" disabled>
                                        {{-- <input type="number" id="user_label" class="form-control form-control-sm {{ $errors->has('user_label') ? 'is-invalid' : '' }}" value="{{ old('user_label') }}" disabled> --}}
                                        {{-- @if($errors->has('user_label'))
                                        <small class="form-text text-danger">{{ $errors->first('user_label') }}</small>
                                        @endif --}}
                                    </div>
                                    <div class="clearfix">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="inactive" class="custom-control-input" id="inactive" value="1" {{ old('inactive') == 1 ? 'checked="checked"' : '' }}>
                                            <label class="custom-control-label" for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div id="drop-area" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
                                <input type="file" id="fileElem" accept="image/*,video/*,audio/*,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,application/vnd.ms-excel,.txt" onchange="handleFiles(this.files)">
                            </div> --}}
                            <div class="row" id="drop-area" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
                                <div class="col-md-12">
                                    <table class="table table-sm table-bordered" id="selected_files_th">
                                        <tr id="select_file_main_label_tr">
                                            <!-- <td class="text-center">SL</td> -->
                                            <td>Type</td>
                                            <td>Description</td>
                                            <td>Drag & Drop</td>
                                            <td></td>
                                        </tr>
                                        
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" disabled>
                                            </td>
                                            <td style="width: 100px;">
                                                <div class="custom-file" style="border: 1px solid #333; width: 70px; height: 30px;">
                                                <input type="file" id="fileElem" class="custom-file-input" accept="image/*,video/*,audio/*,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,application/vnd.ms-excel,.txt" onchange="handleFiles(this.files)">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-secondary" disabled>View</button>
                                            </td>
                                        </tr>

                                        <!-- <tr>
                                            <td class="text-center">1</td>
                                            <td><a href="#">Edit</a> File Name/Description <span class="badge badge-dark">PDF</span></td>
                                            <td><a class="btn btn-sm btn-primary" href="#">View</a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>
                                                <div class="d-flex">
                                                    <input class="form-control form-control-sm" type="text" name="" id="" value="File Name/Description"> <button class="btn btn-sm btn-success ml-2" type="button" style="width: 50px">Save</button>
                                                </div>
                                            </td>
                                            <td><a class="btn btn-sm btn-primary" href="#">View</a></td>
                                        </tr> -->


                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" name="notes" id="notes" placeholder="Enter Notes">{{ old('notes') }}</textarea>
                                    <!-- <input type="file" name="files_data[]" id="fileInput" style="display: none;"> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
<script type="text/javascript">
    var selected_files = [];
    var f_number=1;
    const fileInput = document.getElementById("fileInput");

    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength) {
            object.value = object.value.slice(0, object.maxLength)
        }
    }
    $(document).ready(function() {

    });

    function handleFiles(files) {
        //console.log('files',files);
        files.forEach(function(file, i) {
            console.log('file', file, 'i', i);

            var filename = file.name;
            let last_dot = filename.lastIndexOf('.');
            let ext = filename.slice(last_dot + 1);
            let just_name = filename.slice(0, last_dot);

            let obj = {
                'f_number':f_number,
                'file': file,
                'just_name': just_name,
                'ext':ext,
                'full_name':filename
            };
            selected_files.push(obj);

            let tr_id="selected_file_"+f_number;
            let file_id="selected_file_id_"+f_number;

            var img_html = "";

            img_html += '<tr id='+tr_id+'>';
            //img_html += '<td class="text-center">'+f_number+'</td>';
            // img_html += '<td class="text-center"><input class="form-control form-control-sm" type="text" name="files_name['+f_number+']" id="files_name['+f_number+']" value="' + just_name + '"></td>';
            img_html += '<td style="width: 70px;">';
            img_html += '<div class="d-flex">';
            img_html += '<input class="form-control form-control-sm" type="text" value=".'+ext+'" readonly>';
            img_html += '<input class="form-control form-control-sm" type="file" name="file_data['+f_number+']" id="'+file_id+'" style="display:none">';
            img_html += '</div>';
            img_html += '</td>';
            img_html += '<td><input class="form-control form-control-sm" type="text" name="files_desc['+f_number+']" id="files_desc['+f_number+']" value=""></td>';
            img_html += '<td></td>';
            img_html += '<td><button type="button" class="btn btn-secondary btn-sm" disabled>View</button></td>';
            // img_html += '<td><a class="delate-icon" href="javascript:void(0);" onclick=\'remove_selected_file(' + f_number + ',"'+tr_id+'");\'>X</a></td>';
            img_html += '</tr>';

            //$("#"+file_id).val(file);

            //$("#selected_files_th").append(img_html);
            $('#select_file_main_label_tr').after(img_html);

            let fileInput2 = document.getElementById(file_id);
            let list = new DataTransfer();
            list.items.add(file);
            fileInput2.files = list.files;

            f_number++;

        });

        console.log('selected_files',selected_files);

        $("#fileElem").val('');
    }

    function remove_selected_file(i,tr_id){
        let selected_fdata_index=selected_files.findIndex((d)=>{return d.f_number==i;});
        console.log('selected_fdata_index',selected_fdata_index);
        selected_files.splice(selected_fdata_index, 1);
        $("#"+tr_id).remove();
        //console.log('selected_files',selected_files);
        //f_number--;
    }

    function dropHandler(e) {
        console.log("File(s) dropped");

        // Prevent default behavior (Prevent file from being opened)
        e.preventDefault();

        var dt = e.dataTransfer;
        var files = dt.files;
        handleFiles(files);
    }

    function dragOverHandler(ev) {
        console.log("File(s) in drop zone");

        // Prevent default behavior (Prevent file from being opened)
        ev.preventDefault();
    }
</script>
@endsection
