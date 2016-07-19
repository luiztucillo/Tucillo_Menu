jQuery(function($){

    var tucilloMenu  = {
        init            : function() {

            var obj = this;

            obj.toggleTitleText();
            obj.toggleLinkType();

            $('#title_type').bind('change', function() {
                obj.toggleTitleText();
            });

            $('#link_type').bind('change', function(){
                obj.toggleLinkType();
            });
        },
        toggleTitleText      : function() {
            if ($('#title_type').val() == 1) {
                this.enableTitleText();
            } else {
                this.disableTitleText();
            }
        },
        enableTitleText     : function() {
            $('#title_text').removeAttr('disabled')
                .parents('tr').show();
        },
        disableTitleText    : function() {
            $('#title_text').attr('disabled', 'disabled')
                .parents('tr').hide();
        },
        toggleLinkType      : function() {
            if ($('#link_type').val() == 1) {
                this.enableLinkUrl();
                this.disableCmsPage();
                this.disableCategoryLink();
            } else if ($('#link_type').val() == 2) {
                this.disableLinkUrl();
                this.enableCmsPage();
                this.disableCategoryLink();
            } else if ($('#link_type').val() == 3) {
                this.disableLinkUrl();
                this.disableCmsPage();
                this.enableCategoryLink();
            }
        },
        enableLinkUrl       : function() {
            $('#link_url').removeAttr('disabled')
                .parents('tr').show();
        },
        disableLinkUrl      : function() {
            $('#link_url').attr('disabled', 'disabled')
                .parents('tr').hide();
        },
        enableCmsPage       : function() {
            $('#cms_page').removeAttr('disabled')
                .parents('tr').show();
        },
        disableCmsPage      : function() {
            $('#cms_page').attr('disabled', 'disabled')
                .parents('tr').hide();
        },
        enableCategoryLink  : function() {
            $('#category_id').removeAttr('disabled')
                .parents('tr').show();
        },
        disableCategoryLink : function() {
            $('#category_id').attr('disabled', 'disabled')
                .parents('tr').hide();
        }
    };

    tucilloMenu.init();
});