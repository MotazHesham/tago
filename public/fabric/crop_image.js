

    function cropImage() {
        if(objectToCrop && objectToCrop.type === 'image' && objectToCrop.picArea) {

            if((objectToCrop.width*objectToCrop.scaleX < objectToCrop.picArea.width*objectToCrop.picArea.scaleX) || (objectToCrop.height*objectToCrop.scaleY < objectToCrop.picArea.height * objectToCrop.picArea.scaleY)) {
                //alert(objectToCrop.scaleX + " " + objectToCrop.oldScaleX);
                //objectToCrop.scaleX = objectToCrop.oldScaleX;
                //objectToCrop.scaleY = objectToCrop.oldScaleY;
                //objectToCrop.width = objectToCrop.picArea.width / objectToCrop.scaleX; 
                //objectToCrop.height = objectToCrop.picArea.height / objectToCrop.scaleY;
                //objectToCrop.oldWidth = objectToCrop.width;
                //objectToCrop.oldHeight = objectToCrop.height;
                //objectToCrop.oldScaleX = objectToCrop.scaleX;
                //objectToCrop.oldScaleY = objectToCrop.scaleY;
            } else {
                //crop
                objectToCrop.oldScaleX = objectToCrop.scaleX;
                objectToCrop.oldScaleY = objectToCrop.scaleY;
                objectToCrop.oldWidth = objectToCrop.width;
                objectToCrop.oldHeight = objectToCrop.height;

                objectToCrop.cropX = (objectToCrop.picArea.left - objectToCrop.left) / objectToCrop.scaleX;
                objectToCrop.cropY = (objectToCrop.picArea.top - objectToCrop.top) / objectToCrop.scaleY;

                objectToCrop.width = objectToCrop.picArea.width / objectToCrop.scaleX; 
                objectToCrop.height = objectToCrop.picArea.height / objectToCrop.scaleY;

                objectToCrop.left = objectToCrop.picArea.left;
                objectToCrop.top = objectToCrop.picArea.top;
            }   
            objectToCrop.setCoords();
            fabricCanvasObj.remove(objectToCrop.picArea);
            objectToCrop.opacity = 1;
            objectToCrop.hasRotatingPoint = true;
            objectToCrop.picArea = null;
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
            selectable: false, 
        });

        fabricCanvasObj.add(picArea);
        picArea.setCoords();
        fabricCanvasObj.sendBackwards(picArea); 
        picture.picArea = picArea;
        fabricCanvasObj.renderAll();
    }

    function start_croping(target){
        if(target && target.type === 'image' && !target.picArea) {

            objectToCrop = target;
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