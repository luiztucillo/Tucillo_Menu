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

            this.disableLinkUrl();
            this.disableCmsPage();
            this.disableCategoryLink();

            $('#category_id').bind('change', this.populateCategory);
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
            if ($('#link_type').val() == 1) {//CUSTOM
                this.enableLinkUrl();
                this.disableCmsPage();
                this.disableCategoryLink();
            } else if ($('#link_type').val() == 2) {//CMS
                this.disableLinkUrl();
                this.enableCmsPage();
                this.disableCategoryLink();
            } else if ($('#link_type').val() == 3) {//CATEGORY
                this.disableLinkUrl();
                this.disableCmsPage();
                this.enableCategoryLink();
                this.populateCategory();
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
        },
        populateCategory    : function() {

            var url     = $('#url_get_categories').val();
            var obj     = $('#category_id');
            var id      = $('#category_id').val();
            var text    = $('#category_id option:selected').text();

            $('#loading-mask').show();

            $('body').append('<div id="prevent-click-loading" />');
            $('#prevent-click-loading').css({
                position    : 'fixed',
                left        : 0,
                top         : 0,
                width       : $(window).width(),
                height      : $(window).height(),
                background  : '#fff',
                opacity     : 0.3
            });

            $.get(url, {parent_id : id}, function(result) {
                obj.html('');
                obj.append('<option value=""></option>');
                if (id) {
                    obj.append('<option value="' + id + '">' + text + '</option>');
                }
                $.each(result, function(key, value) {
                    obj.append('<option value="'+value.value+'">'+value.label+'</option>');
                });

                if (id) {
                    obj.val(id);
                }

                $('#loading-mask').hide();
                $('#prevent-click-loading').remove();

            }, 'json');
        }
    };

    tucilloMenu.init();
});