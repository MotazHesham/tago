@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body">
            <p>
                <lable>Text To Write</lable>
                <input class="form-control" name="text_to_write" id="text_to_write" value="https://my-tago.com/user/">
                <br>
                <lable>Type</lable>
                <input class="form-control" name="type" id="type" value="url">
                <br>
                <button onclick="readTag()" class="btn btn-success">Test NFC Read</button>
                <button onclick="writeTag()" class="btn btn-danger">Test NFC Write</button>
            </p>
            <pre id="log"></pre>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        async function readTag() {
            if ("NDEFReader" in window) {
                const ndef = new NDEFReader();
                try {
                    await ndef.scan();
                    ndef.onreading = event => {
                        const decoder = new TextDecoder();
                        for (const record of event.message.records) {
                            consoleLog("Record type:  " + record.recordType);
                            consoleLog("MIME type:    " + record.mediaType);
                            consoleLog("=== data ===\n" + decoder.decode(record.data));
                        }
                    }
                } catch (error) {
                    consoleLog(error);
                }
            } else {
                consoleLog("Web NFC is not supported.");
            }
        }

        async function writeTag() {
            if ("NDEFReader" in window) {
                const ndef = new NDEFReader();
                try {
                    await ndef.write({
                        records: [{
                            recordType: document.getElementById('type')
                                .value, // NFC record type for URLs
                            data: document.getElementById('text_to_write').value
                        }]
                    });
                    consoleLog("NDEF message written!");
                } catch (error) {
                    consoleLog(error);
                }
            } else {
                consoleLog("Web NFC is not supported.");
            }
        }

        function consoleLog(data) {
            var logElement = document.getElementById('log');
            logElement.innerHTML += data + '\n';
        };
    </script>
@endsection
