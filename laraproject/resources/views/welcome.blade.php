<!DOCTYPE html>
<html>
    <head>
        <title>Тестовое задание</title>

        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            /*html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }*/
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                {{--<div class="title">Laravel 5</div>--}}

                <div class="site-index">

                    <div class="body-content">

                        <form id="theForm">
                            <table>
                                <tr>
                                    <th>Длинный URL</th>
                                    <th>Короткий URL</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="url" name="url" id="url">
                                        <input type="button" value="Do!" id="geturl">
                                    </td>
                                    <td id="result"></td>
                                </tr>
                            </table>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        </form>

                    </div>
                </div>
                <script>
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $("#geturl").click(function(){
                        $.ajax({
                            url: '<?php echo route('shorturl'); ?>',
                            data: $("#theForm").serialize(),
                            dataType: 'json',
                            success: function( data ) {
                                $( "#result" ).html( data.message );
                            },
                            type: "post"
                        });
                    });
                </script>

            </div>
        </div>
    </body>
</html>
