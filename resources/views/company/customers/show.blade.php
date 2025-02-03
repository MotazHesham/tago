@extends('layouts.company')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#user_user_links" role="tab" data-toggle="tab">
                        {{ trans('cruds.userLink.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#user_connections" role="tab" data-toggle="tab">
                        {{ trans('cruds.connection.title') }}
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="#user_active" role="tab" data-toggle="tab">
                        active
                    </a>
                </li> 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="user_user_links">
                    @includeIf('company.customers.relationships.userUserLinks', ['userLinks' => $user->userUserLinks])
                </div>
                <div class="tab-pane" role="tabpanel" id="user_connections">
                    @includeIf('company.customers.relationships.userConnections', ['connections' => $user->userConnections])
                </div> 
                <div class="tab-pane" role="tabpanel" id="user_active">
                    @includeIf('company.customers.relationships.active')
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.user.title_singular') }}
            </div>
        
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('company.customers.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.id') }}
                                </th>
                                <td>
                                    {{ $user->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone_number') }}
                                </th>
                                <td>
                                    {{ $user->phone_number }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.nickname') }}
                                </th>
                                <td>
                                    {{ $user->nickname }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.bio') }}
                                </th>
                                <td>
                                    {{ $user->bio }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Qr Activated
                                </th>
                                <td>
                                    @if($user->active_byqr)
                                        <i class="far fa-check-circle" style="color:green"></i>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email_active') }}
                                </th>
                                <td> 
                                    <label class="c-switch c-switch-pill c-switch-success">
                                        <input onchange="update_statuses(this,'email_active')" value="{{ $user->id }}"
                                            type="checkbox" class="c-switch-input"
                                            {{ $user->email_active ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.nickname_active') }}
                                </th>
                                <td>
                                    <label class="c-switch c-switch-pill c-switch-success">
                                        <input onchange="update_statuses(this,'nickname_active')" value="{{ $user->id }}"
                                            type="checkbox" class="c-switch-input"
                                            {{ $user->nickname_active ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                    </label> 
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.bio_active') }}
                                </th>
                                <td>
                                    <label class="c-switch c-switch-pill c-switch-success">
                                        <input onchange="update_statuses(this,'bio_active')" value="{{ $user->id }}"
                                            type="checkbox" class="c-switch-input"
                                            {{ $user->bio_active ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                    </label> 
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.photo') }}
                                </th>
                                <td>
                                    @if($user->photo)
                                        <a href="{{ $user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $user->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.cover') }}
                                </th>
                                <td>
                                    @if($user->cover)
                                        <a href="{{ $user->cover->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $user->cover->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr> 
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('company.customers.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
    <script>
        
        function update_statuses(el,type){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('company.customers.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status, type:type}, function(data){
                if(data == 1){
                    showAlert('success', 'Success', '');
                }else{
                    showAlert('danger', 'Something went wrong', '');
                }
            });
        }
        function update_statuses2(el,type){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('company.user-links.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status, type:type}, function(data){
                if(data == 1){
                    showAlert('success', 'Success', '');
                }else{
                    showAlert('danger', 'Something went wrong', '');
                }
            });
        }
    </script>
    
    <script> 

        var myOffcanvas = document.getElementById('offcanvasNFC');
        const success = ` 
                <img width="200" src="{{ asset('success.gif') }}" alt="">
                <h3 class="py-2">Card Activated Successfully</h3>`;

        async function writeTag() {
            var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
            bsOffcanvas.show();

            if ("NDEFReader" in window) {
                const ndef = new NDEFReader();
                try {
                    await ndef.write({
                        records: [{
                            recordType: 'url',
                            data: '{{ route("frontend.user",$user->id) }}'
                        }]
                    });
                    $('#ready_to_scan').html(success);
                } catch (error) {
                    errorWriteNFC(error);
                }
            } else {
                errorWriteNFC("Web NFC is not supported.");
            }
        }
        
        function errorWriteNFC(data) {
            var logElement = document.getElementById('error_nfc');
            logElement.innerHTML = data;
        };
    </script>
    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest/umd/index.min.js"></script>
    <script type="text/javascript">

        function decodeOnce(codeReader, selectedDeviceId) {
            codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
                console.log(result.text) 

                $.post('{{ route('company.customers.qr_scanned') }}', {
                    _token: '{{ csrf_token() }}',
                    token: result.text, 
                    user_id : '{{ $user->id }}'
                }, function(data) {
                    console.log(data);
                    $('#ready_to_scan').html(success); 
                });
            }).catch((err) => {
                console.error(err)
                document.getElementById('result').textContent = err
                const myTimeout = setTimeout(load_cam, 5000);
            })
        }


        function load_cam() {

            let selectedDeviceId;
            const codeReader = new ZXing.BrowserQRCodeReader();
            console.log('ZXing code reader initialized');

            const decodingStyle = document.getElementById('decoding-style').value;

            decodeOnce(codeReader, selectedDeviceId);

            console.log(`Started decode from camera with id ${selectedDeviceId}`)

            codeReader.getVideoInputDevices()
                .then((videoInputDevices) => {

                    const sourceSelect = document.getElementById('sourceSelect')
                    selectedDeviceId = videoInputDevices[0].deviceId

                    if (videoInputDevices.length >= 1) {
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option')
                            sourceOption.text = element.label
                            sourceOption.value = element.deviceId
                            sourceSelect.appendChild(sourceOption)
                        })

                        sourceSelect.onchange = () => {
                            selectedDeviceId = sourceSelect.value;
                        };

                        const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                        sourceSelectPanel.style.display = 'block'
                    }

                    document.getElementById('startButton').addEventListener('click', () => {
                        const decodingStyle = document.getElementById('decoding-style').value;

                        decodeOnce(codeReader, selectedDeviceId);

                        console.log(`Started decode from camera with id ${selectedDeviceId}`)
                    })

                    document.getElementById('resetButton').addEventListener('click', () => {
                        codeReader.reset()
                        document.getElementById('result').textContent = '';
                        console.log('Reset.')
                    })

                })

                .catch((err) => {
                    console.error(err)
                })

        }
    </script>
@endsection