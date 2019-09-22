$(document).ready(function(){
    var full_path = location.href.split("#")[0];
    $("#sidebar_nav a").each(function(){
        var $this = $(this);
        if($this.prop("href").split("#")[0] == full_path && $this.data('toggle') !== 'collapse') {
            $this.addClass("active");
        }
    });

    $("#sidebar_nav a[data-toggle=collapse]").each(function(){
        var $this = $(this);
        $($this.attr('href')).on('show.bs.collapse', function () {
            $this.addClass('sidebar__nav-item_showing');
            $(this).addClass('sidebar__nav-item_showing');
        })

        $($this.attr('href')).on('hide.bs.collapse', function () {
            $this.removeClass('sidebar__nav-item_showing');
            $(this).removeClass('sidebar__nav-item_showing');
        })
    });
});
