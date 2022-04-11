<script type='text/javascript' id="ajax-templates">
    var ajaxTemplates = new Object;
    
    window.ajaxTemplates['posts'] = {
        url: '<?php echo get_rest_url(null,'api/v0/posts'); ?>',
        infiniteScroll: false,
        isNew: true,
        onLoad: true,
        loop: false,
        type: 'GET',
        vars: {
            lang: '<?php pll_current_language(); ?>',
            per_page: 12,
            category: 'category',
        },
    }

</script>