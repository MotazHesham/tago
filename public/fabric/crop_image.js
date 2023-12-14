

    function cropImage() {
        if(selectedObject && selectedObject.type === 'image' && selectedObject.picArea) {

            console.log(selectedObject.picArea);
            if((selectedObject.width*selectedObject.scaleX < selectedObject.picArea.width*selectedObject.picArea.scaleX) || (selectedObject.height*selectedObject.scaleY < selectedObject.picArea.height * selectedObject.picArea.scaleY)) {
                //alert(selectedObject.scaleX + " " + selectedObject.oldScaleX);
                //selectedObject.scaleX = selectedObject.oldScaleX;
                //selectedObject.scaleY = selectedObject.oldScaleY;
                //selectedObject.width = selectedObject.picArea.width / selectedObject.scaleX; 
                //selectedObject.height = selectedObject.picArea.height / selectedObject.scaleY;
                //selectedObject.oldWidth = selectedObject.width;
                //selectedObject.oldHeight = selectedObject.height;
                //selectedObject.oldScaleX = selectedObject.scaleX;
                //selectedObject.oldScaleY = selectedObject.scaleY;
            } else {
                //crop
                selectedObject.oldScaleX = selectedObject.scaleX;
                selectedObject.oldScaleY = selectedObject.scaleY;
                selectedObject.oldWidth = selectedObject.width;
                selectedObject.oldHeight = selectedObject.height;

                selectedObject.cropX = (selectedObject.picArea.left - selectedObject.left) / selectedObject.scaleX;
                selectedObject.cropY = (selectedObject.picArea.top - selectedObject.top) / selectedObject.scaleY;

                selectedObject.width = selectedObject.picArea.width / selectedObject.scaleX; 
                selectedObject.height = selectedObject.picArea.height / selectedObject.scaleY;

                selectedObject.left = selectedObject.picArea.left;
                selectedObject.top = selectedObject.picArea.top;
            }   
            selectedObject.setCoords();
            fabricCanvasObj.remove(selectedObject.picArea);
            selectedObject.opacity = 1;
            selectedObject.hasRotatingPoint = true;
            selectedObject.picArea = null;
            fabricCanvasObj.discardActiveObject();

            console.log(fabricCanvasObj.toJSON());

            isCrop = false; 
        }

    } 

    function addPictureArea(picture) {
        var picArea = new fabric.Rect({
            strokeWidth: 1,
            fill: 'grey',
            opacity: .5,
            width: picture.width * picture.scaleX,
            height: picture.height * picture.scaleY,
            left: picture.left,
            top: picture.top,
            angle: picture.angle,
            selectable: false
        });

        fabricCanvasObj.add(picArea);
        picArea.setCoords();
        fabricCanvasObj.sendToBack(picArea);
        picture.picArea = picArea;
        fabricCanvasObj.renderAll();
    }

    function start_croping(target){
        if(target && target.type === 'image' && !target.picArea) {
            
            isCrop = true;

            addPictureArea(target);
            target.opacity = 0.7;
            target.hasRotatingPoint = false;
            
            if(target.cropX) {
                target.left = target.picArea.left - target.cropX * target.scaleX;
                target.top = target.picArea.top - target.cropY * target.scaleY;

                target.scaleX = target.oldScaleX;
                target.scaleY = target.oldScaleY;

                target.width = target.oldWidth; 
                target.height = target.oldHeight;

                target.cropX = 0;
                target.cropY = 0;            

                target.setCoords();
            }
            fabricCanvasObj.renderAll(); 
            save_state();
        }
    }
    
    fabric.Image.prototype._renderFill = function(ctx) {
        var elementToDraw = this._element,
            w = this.width, h = this.height,
            sW = Math.min(elementToDraw.naturalWidth || elementToDraw.width, w * this._filterScalingX),
            sH = Math.min(elementToDraw.naturalHeight || elementToDraw.height, h * this._filterScalingY),
            x = -w / 2, y = -h / 2,
            sX = this.cropX * this._filterScalingX,
            sY = this.cropY * this._filterScalingY;

        elementToDraw && ctx.drawImage(elementToDraw, sX, sY, sW, sH, x, y, w, h);
    };