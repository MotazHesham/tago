exampleMenuItemSource = function (selector) {
    if ($(selector).attr('id') == 'PNG_JPG') {
        return [
                {
                    header: 'Example Dynamic'
                },
                {
                    text: 'PNG',
                    action: function(e, selector) { alert('PNG clicked on ' + selector.prop("tagName") + ":" + selector.attr("id")); }
                },
                {
                    text: 'JPG',
                    action: function(e, selector) { alert('JPG clicked on ' + selector.prop("tagName") + ":" + selector.attr("id")); }
                },
                {   divider: true   },
                {
                    icon: 'glyphicon-list-alt',
                    text: 'Dynamic nested',
                    subMenu : [
                    {
                        text: 'More dynamic',
                        action: function(e, selector) { alert('More dynamic clicked on ' + selector.prop("tagName") + ":" + selector.attr("id")); }
                    },
                    {
                        text: 'And more...',
                        action: function(e, selector) { alert('And more... clicked on ' + selector.prop("tagName") + ":" + selector.attr("id")); }
                    }
                    ]
                }
            ]
    } else {
        return [
                {
                    icon: 'glyphicon-exclamation-sign',
                    text: 'No image types supported!'
                }
            ]
    }
}

test_menu = {
    id: 'TEST-MENU',
    data: [
        // {
        //     header: 'Example'
        // },
        {
            icon: 'fa-solid fa-copy',
            text: 'Duplicate',
            action: function(e, selector) { 
                duplicate_element();
            }
        },
        {
            icon: 'a-sharp fa-light fa-trash',
            text: 'Delete',
            action: function(e, selector) {
                delete_element();
            }
        },
        {
            divider: true
        }, 
        { 
            text: 'Align to page:',
            subMenu : [
                {
                    text: 'Left',
                    icon: 'fa-solid fa-objects-align-left',
                    action: function(e, selector) {
                        alignLeft();
                    }
                }, 
                {
                    text: 'Center',
                    icon: 'fa-solid fa-objects-align-center-horizontal',
                    action: function(e, selector) {
                        alignCenter();
                    }
                }, 
                {
                    text: 'Right',
                    icon: 'fa-solid fa-objects-align-right',
                    action: function(e, selector) {
                        alignRight();
                    }
                }, 
                {
                    text: 'Top',
                    icon: 'fa-solid fa-objects-align-top',
                    action: function(e, selector) {
                        alignTop();
                    }
                }, 
                {
                    text: 'Middle',
                    icon: 'fa-solid fa-distribute-spacing-vertical',
                    action: function(e, selector) {
                        alignMiddle();
                    }
                }, 
                {
                    text: 'Bottom',
                    icon: 'fa-solid fa-objects-align-bottom',
                    action: function(e, selector) {
                        alignBottom();
                    }
                }, 
            ]
        },
        { 
            text: 'Layer:',
            subMenu : [
                {
                    text: 'Bring forward',
                    icon: 'fa-regular fa-bring-forward',
                    action: function(e, selector) {
                        bringForward();
                    }
                }, 
                {
                    text: 'Bring to front',
                    icon: 'fa-sharp fa-solid fa-bring-front',
                    action: function(e, selector) {
                        bringToFront();
                    }
                }, 
                {
                    text: 'Send backward',
                    icon: 'fa-regular fa-send-back',
                    action: function(e, selector) {
                        sendBackward();
                    }
                }, 
                {
                    text: 'Send to back',
                    icon: 'fa-duotone fa-send-backward',
                    action: function(e, selector) {
                        sendToBack();
                    }
                },  
            ]
        },
        { 
            text: 'Flip:',
            icon:'fa-solid fa-chevron-right',
            subMenu : [
                {
                    text: 'Flip horizontal',
                    icon: 'fa-solid fa-left-right',
                    action: function(e, selector) {
                        flipHorizontal();
                    }
                }, 
                {
                    text: 'Flip vertical',
                    icon: 'fa-solid fa-up-down',
                    action: function(e, selector) {
                        flipVertical();
                    }
                },  
            ]
        },
    ]
};

test_menu2 = [
    {
        header: 'Example'
    },
    {
        icon: 'glyphicon-plus',
        text: 'Create',
        action: function(e, selector) { alert('Create clicked on ' + selector.prop("tagName") + ":" + selector.attr("id")); }
    },
    {
        icon: 'glyphicon-edit',
        text: 'Edit',
        action: function(e, selector) { alert('Edit clicked on ' + selector.prop("tagName") + ":" + selector.attr("id")); }
    }
];
