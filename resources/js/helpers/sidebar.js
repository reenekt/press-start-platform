$(document).ready(function(){
    var full_path = location.href.split("#")[0];
    var parent_path = location.href.split("#")[0].substring(0, full_path.lastIndexOf( "/" ));
    console.log(parent_path)
    $("#sidebar_nav a").each(function(){
        var $this = $(this);
        if($this.prop("href").split("#")[0] === full_path && $this.data('toggle') !== 'collapse') {
            $this.addClass("active");
            $this.parent().parent().parent().collapse('show');
            $this.parent().parent().parent().addClass('sidebar__nav-item_showing');
        }
        if($this.prop("href").split("#")[0] === parent_path && $this.data('toggle') !== 'collapse') {
            $this.addClass("active");
            $this.parent().parent().parent().collapse('show');
            $this.parent().parent().parent().addClass('sidebar__nav-item_showing');
            $this.parent().parent().parent().addClass('sidebar__nav-item_showing');
            console.log($this.parent().parent().parent().attr('id'))
            $('a[href="#'+$this.parent().parent().parent().attr('id')+'"]').addClass('sidebar__nav-item_showing');
        }
    });

    $("#sidebar_nav a[data-toggle=collapse]").each(function(){
        var $this = $(this);
        $($this.attr('href')).on('show.bs.collapse', function () {
            $this.addClass('sidebar__nav-item_showing');
            $(this).addClass('sidebar__nav-item_showing');
        });

        $($this.attr('href')).on('hide.bs.collapse', function () {
            $this.removeClass('sidebar__nav-item_showing');
            $(this).removeClass('sidebar__nav-item_showing');
        });
    });
});
