<div class="card">
    <div class="card-body">
        <div style="display: flex;justify-content:space-evenly">
            <button onclick="writeTag()" class="btn btn-success btn-lg">Begin Active NFC</button>
            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasQR" aria-controls="offcanvasQR" class="btn btn-info btn-lg">Begin Active QR</button>
        </div>
    </div> 

    <div class="offcanvas offcanvas-bottom offcanvas-size-lg" tabindex="-1" id="offcanvasNFC" aria-labelledby="offcanvasNFCLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNFCLabel"></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="text-center">
                <div id="ready_to_scan">
                    <h3>Ready To Scan</h3>
                    <img width="200" src="{{ asset('nfc_scann.gif') }}" alt="">
                    <p>Hold Your Device Near The NFC Tag.</p>
                    <pre id="error_nfc" style="color:red"></pre> 
                </div>
                <button class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom offcanvas-size-lg" tabindex="-1" id="offcanvasQR" aria-labelledby="offcanvasQRLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasQRLabel"></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="text-center">
                <div id="ready_to_scan">
                    <h3>Ready To Scan</h3>
                    <section class="container" id="cam-content">
                        <div class="mb-3">
                            <button class="btn btn-pill btn-lg btn-success" id="startButton" onclick="load_cam()">Start</button>
                            <button class="btn btn-pill btn-lg btn-info " id="resetButton">Stop</button>
                        </div>
    
                        <div>
                            <video id="video" width="300" height="200" style="border: 1px solid gray"></video>
                        </div>
    
                        <div id="sourceSelectPanel" style="display:none">
                            <span for="sourceSelect">Change video source:</span>
                            <select id="sourceSelect" style="max-width:400px">
                            </select>
                        </div> 
    
                        <div style="display: none" class="text-center">
                            <span for="decoding-style"> Decoding Style:</span>
                            <select id="decoding-style" size="1">
                                <option value="once">Decode once</option>
                                <option value="continuously">Decode continuously</option>
                            </select>
                        </div> 
                        <pre style="color:red"><code id="result"></code></pre>
                    </section>
                </div>
                <button class="btn btn-light" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </div>
    </div>
</div>
