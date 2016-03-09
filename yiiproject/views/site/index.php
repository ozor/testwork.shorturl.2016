<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
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
        </form>

    </div>
</div>
<script>
    $("#geturl").click(function(){
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['site/ajax'], 'http'); ?>',
            data: $("#theForm").serialize(),
            dataType: 'json',
            success: function( data ) {
                $( "#result" ).html( data.message );
            }
        });
    });
</script>