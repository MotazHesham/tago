<button type="button" class="btn btn-custom  btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
    data-bs-title="Duplicate" onclick="duplicate_element()"><i class="fa-duotone fa-copy"></i></button>
<button type="button" class="btn btn-custom  btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
    data-bs-title="Remove" onclick="delete_element()"><i class="fa-duotone fa-trash-can-list"></i></button>
<div class="btn-group" role="group">
    <button type="button" class="btn btn-custom btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-duotone fa-ellipsis" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="More"></i>
    </button>
    <ul class="dropdown-menu" style="padding: 6px;width:215px">
        <li><a class="dropdown-item" href="#" onclick="copy_element()">
                <div><i class="fa-duotone fa-copy"></i> <b>Copy</b></div> <span
                    class="badge text-bg-light">Ctrl+C</span>
            </a></li>
        <li><a class="dropdown-item" href="#" onclick="paste_element()">
                <div><i class="fa-duotone fa-clipboard"></i> <b>Paste</b></div> <span
                    class="badge text-bg-light">Ctrl+V</span>
            </a></li>
        <li><a class="dropdown-item" href="#" onclick="duplicate_element()">
                <div><i class="fa-duotone fa-clone"></i> <b>Duplicate</b></div> <span
                    class="badge text-bg-light">Ctrl+B</span>
            </a></li>
        <li><a class="dropdown-item" href="#" onclick="delete_element()">
                <div><i class="fa-duotone fa-trash-can-list"></i> <b>Delete</b></div> <span
                    class="badge text-bg-light">DELETE</span>
            </a></li>
        <li><a class="dropdown-item" href="#" onclick="lock_element()">
                <div><i class="fa-duotone fa-lock-open"></i> <b>Lock</b></div> <span></span>
            </a></li>
        <div class="dropdown-divider"></div>
        <li class="dropdown-submenu">
            <a class="test" tabindex="-1" href="#">
                <div><i class="fa-duotone fa-objects-align-left"></i> <b>Align</b></div> <i
                    class="fa-duotone fa-chevron-right"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" onclick="alignLeft()"><i
                            class="fa-duotone fa-objects-align-left"></i> <b>Left</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignCenter()"><i
                            class="fa-duotone fa-objects-align-center-horizontal"></i> <b>Center</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignRight()"><i
                            class="fa-duotone fa-objects-align-right"></i> <b>Right</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignTop()"><i
                            class="fa-duotone fa-objects-align-top"></i> <b>Top</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignMiddle()"><i
                            class="fa-duotone fa-distribute-spacing-vertical"></i> <b>Middle</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignBottom()"><i
                            class="fa-duotone fa-objects-align-bottom"></i> <b>Bottom</b></a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a class="test" tabindex="-1" href="#">
                <div><i class="fa-duotone fa-layer-group"></i> <b>Layer</b></div> <i
                    class="fa-duotone fa-chevron-right"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" onclick="bringForward()"><i
                            class="fa-duotone fa-bring-forward"></i> <b>Bring forward</b></a></li>
                <li><a tabindex="-1" href="#" onclick="bringToFront()"><i class="fa-duotone fa-bring-front"></i>
                        <b>Bring to front</b></a></li>
                <li><a tabindex="-1" href="#" onclick="sendBackward()"><i class="fa-duotone fa-send-back"></i>
                        <b>Send backward</b></a></li>
                <li><a tabindex="-1" href="#" onclick="sendToBack()"><i class="fa-duotone fa-send-backward"></i>
                        <b>Send to back</b></a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a class="test" tabindex="-1" href="#">
                <div><i class="fa-duotone fa-duotone fa-reflect-horizontal"></i> <b>Flip</b></div> <i
                    class="fa-duotone fa-chevron-right"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" onclick="flipHorizontal()"><i
                            class="fa-duotone fa-left-right"></i> <b>Flip Horizontal</b></a></li>
                <li><a tabindex="-1" href="#" onclick="flipVertical()"><i class="fa-duotone fa-up-down"></i>
                        <b>Flip Vertical</b></a></li>
            </ul>
        </li>
    </ul>
</div>
