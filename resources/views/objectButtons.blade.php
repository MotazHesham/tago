<button type="button" class="btn btn-custom  btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
    data-bs-title="Duplicate" onclick="duplicate_element()"><i class="fa-light fa-copy"></i></button>
<button type="button" class="btn btn-custom  btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom"
    data-bs-title="Remove" onclick="delete_element()"><i class="fa-light fa-trash-can-list"></i></button>
<div class="btn-group" role="group">
    <button type="button" class="btn btn-custom btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-light fa-ellipsis" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="More"></i>
    </button>
    <ul class="dropdown-menu" style="padding: 6px;width:215px">
        <li><a class="dropdown-item" href="#" onclick="duplicate_element()">
                <div><i class="fa-thin fa-copy"></i> <b>Duplicate</b></div> <span
                    class="badge text-bg-light">Ctrl+D</span>
            </a></li>
        <li><a class="dropdown-item" href="#" onclick="delete_element()">
                <div><i class="fa-thin fa-trash-can-list"></i> <b>Delete</b></div> <span
                    class="badge text-bg-light">DELETE</span>
            </a></li>
        <li><a class="dropdown-item" href="#" onclick="lock_element()">
                <div><i class="fa-thin fa-lock-open"></i> <b>Lock</b></div> <span></span>
            </a></li>
        <div class="dropdown-divider"></div>
        <li class="dropdown-submenu">
            <a class="test" tabindex="-1" href="#">
                <div><i class="fa-thin fa-objects-align-left"></i> <b>Align</b></div> <i
                    class="fa-thin fa-chevron-right"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" onclick="alignLeft()"><i
                            class="fa-thin fa-objects-align-left"></i> <b>Left</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignCenter()"><i
                            class="fa-thin fa-objects-align-center-horizontal"></i> <b>Center</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignRight()"><i
                            class="fa-thin fa-objects-align-right"></i> <b>Right</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignTop()"><i
                            class="fa-thin fa-objects-align-top"></i> <b>Top</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignMiddle()"><i
                            class="fa-thin fa-distribute-spacing-vertical"></i> <b>Middle</b></a></li>
                <li><a tabindex="-1" href="#" onclick="alignBottom()"><i
                            class="fa-thin fa-objects-align-bottom"></i> <b>Bottom</b></a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a class="test" tabindex="-1" href="#">
                <div><i class="fa-thin fa-layer-group"></i> <b>Layer</b></div> <i
                    class="fa-thin fa-chevron-right"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" onclick="bringForward()"><i
                            class="fa-thin fa-bring-forward"></i> <b>Bring forward</b></a></li>
                <li><a tabindex="-1" href="#" onclick="bringToFront()"><i class="fa-thin fa-bring-front"></i>
                        <b>Bring to front</b></a></li>
                <li><a tabindex="-1" href="#" onclick="sendBackward()"><i class="fa-thin fa-send-back"></i>
                        <b>Send backward</b></a></li>
                <li><a tabindex="-1" href="#" onclick="sendToBack()"><i class="fa-thin fa-send-backward"></i>
                        <b>Send to back</b></a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a class="test" tabindex="-1" href="#">
                <div><i class="fa-thin fa-thin fa-reflect-horizontal"></i> <b>Flip</b></div> <i
                    class="fa-thin fa-chevron-right"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="#" onclick="flipHorizontal()"><i
                            class="fa-thin fa-left-right"></i> <b>Flip Horizontal</b></a></li>
                <li><a tabindex="-1" href="#" onclick="flipVertical()"><i class="fa-thin fa-up-down"></i>
                        <b>Flip Vertical</b></a></li>
            </ul>
        </li>
    </ul>
</div>
