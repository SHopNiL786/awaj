var WPModul3r = (function($, document, window, undefined){

    var init = function() {
        addNewFieldRow();
        removeFieldRow();
        convertFieldKeyToSlug();
        wpMediaUploader();
        deleteThisSucker();
    }

    /**
     * Add new field row after clicking in cta
     */
    var addNewFieldRow = function() {
        $('html').on('click', '.wp-modul3r-form-repeater-add-cta', function(event) {
            event.preventDefault();

            var html = $('#template-field').html();
            $(this).closest('.wp-modul3r-form-repeater').find('.wp-modul3r-form-repeater-content').append(html)
                .find('.wp-modul3r-form-repeater-content-row:last input[name="structure[key][]"]').focus();
        });

        if($('#name').val().length === 0) {
            $('.wp-modul3r-form-repeater-add-cta').trigger('click');
        }

        $( ".wp-modul3r-form-repeater-content" ).sortable();
    }

    /**
     * Remove current field row
     */
    var removeFieldRow = function() {
        $('html').on('click', '.wp-modul3r-form-repeater-content-row .button', function(event) {
            event.preventDefault();

            if(confirm('Are you sure?')) {
                $('.wp-modul3r-form-repeater-content .wp-modul3r-form-repeater-content-row:last').remove();
            }
        });
    }

    /**
     * Convert field key text to slug
     */
    var convertFieldKeyToSlug = function() {
        $('html').on('change', '.wp-modul3r-form-repeater-content-row input[name="structure[key][]"]', function(event) {
            event.preventDefault();

            var value = $(this).val();
            $(this).val(convertToSlug(value));
        });
    }

    /**
     * Convert text to slug
     */
    var convertToSlug = function (text) {
        return text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'');
    }

    /**
     * Wordpress default media uploader
     */
    var wpMediaUploader = function() {

        $('html').on('click', '.wp-modul3r-field-media-reset', function(e){
            e.preventDefault();

            if (confirm('You are sure?')) {
                var $container = $(this).closest('.wp-modul3r-field-media');
                $container.find('.wp-modul3r-field-media-preview').html('');
                $container.find('.wp-modul3r-field-media-input').val('');

                var name = $container.find('.wp-modul3r-field-media-input').attr('name');
                if ($('input[name="'+ name +'_link"]').length > 0) {
                    $('input[name="'+ name +'_link"]').val('');
                }
            }
        });

        $('html').on('click', '.wp-modul3r-field-media-opener', function(e) {
            e.preventDefault();
            var image_frame;

            var $input = $(this).closest('.wp-modul3r-field-media').find('.wp-modul3r-field-media-input');
            var $preview = $(this).closest('.wp-modul3r-field-media').find('.wp-modul3r-field-media-preview');
            var isMultiple = $(this).closest('.wp-modul3r-field-media').attr('data-rel') ? true : false;
            var title = $(this).closest('.wp-modul3r-field-media').attr('data-title');
            var isFileUploader = $(this).closest('.wp-modul3r-field-media').attr('data-file-upload');

            if (image_frame) {
                image_frame.open();
            }

            var wpMediaSettings = {
                title: title,
                multiple: isMultiple
            }

            if(!isFileUploader) {
                wpMediaSettings.library = {
                    type: 'image'
                }
            }

            image_frame = wp.media(wpMediaSettings);

            image_frame.on('close', function() {
                var selection = image_frame.state().get('selection');
                var gallery_ids = new Array();
                var my_index = 0;
                selection.each(function(attachment) {
                    gallery_ids[my_index] = attachment['id'];
                    my_index++;
                });
                var ids = gallery_ids.join(",");

                $input.val(ids);

                refreshImage(ids, $preview);
            });

            image_frame.on('open', function() {
                var selection = image_frame.state().get('selection');
                ids = $input.val().split(',');
                ids.forEach(function(id) {
                    attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add(attachment ? [attachment] : []);
                });

            });

            image_frame.open();
        });

    }

    /**
     * Wordpress image media previre after select
     *
     * @param the_id
     * @param $preview
     * @returns {boolean}
     */
    var refreshImage = function (the_id, $preview){
        if(!the_id) {
            return false;
        }

        var data = {
            action: 'wp_modul3r_get_image',
            id: the_id
        };

        $.get(ajaxurl, data, function(response) {
            if(response.success === true) {
                $preview.html('');

                $.each(response.data, function(index, val) {
                    $preview.append(val);
                });
            }
        });
    }

    var deleteThisSucker = function() {
        $('html').on('click', '#delete', function(event) {
            if(!confirm("This will permanently delete all data! Are you sure?")) {
                event.preventDefault();
            }
        });
    }

    return {
        init: init
    }

})(jQuery, document, window);

WPModul3r.init();
