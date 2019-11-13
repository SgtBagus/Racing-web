<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="box-title" align="center">Event</h3>
                <form role="form" action="<?= base_url('event') ?>" method="GET">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cari Event</label>
                        <input type="text" name="title" class="form-control" <?php if ($_GET['title']) {
                                                                                    echo 'value="' . $_GET['title'] . '"';
                                                                                } ?> id="filter-search">
                    </div>
                    <div class="form-group" align="center">
                        <button type="submit" class="btn btn-lg btn-block btn-primary">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div id="load_data">
            </div>
        </div>
        <div id="load_data_message"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var limit = 6;
        var start = 0;
        var action = 'inactive';
        var search = 0;

        function load_data(limit, start) {
            lazzy_loader(limit);
            search = $('#filter-search').val();
            
            $.ajax({
                url: "<?= base_url(); ?>event/fetch?title=" + search,
                method: "POST",
                data: {
                    limit: limit,
                    start: start
                },
                cache: false,
                success: function(data) {
                    if (data == '') {
                        $('#load_data_message').html('<div class="row">' +
                            '<div class="col-xs-12" align="center">' +
                            'Semua Event telah Ditampilkan' +
                            '</div>' +
                            '</div>');
                        action = 'active';
                    } else {
                        $('#load_data').append(data);
                        $('#load_data_message').hide('');
                        action = 'inactive';
                    }
                }
            })
        }
        if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
        }
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
                lazzy_loader(limit);
                action = 'active';
                start = start + limit;
                setTimeout(function() {
                    load_data(limit, start);
                }, 1000);
            }
        });
    });
</script>