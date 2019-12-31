<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Tombola!</title>
</head>
<body>

<div class="container">
    <div class="seven col">
        <div class="table-container">
            <table id="tavola">&nbsp;</table>
        </div>
        <div class="bottom-links">
            <span class="link" id="btnReset">Reset</span> / 
            <span class="link" id="btnRefresh" data-state="on">Aggiornamento automatico: on</span>
            <!--span class="link" id="btnShow" data-state="all">Mostra: tutto</span-->
        </div>
    </div>

    <div class="five col">
        <div class="center-text">
            <h1 class="title">TOMBOLA!</h1>
            <div class="last-called">
                <div class="btn-holder">
                    <button class="btn-call" id="btnCall">Estrai</button>
                </div>
                <p>Ultimi estratti:</p>
                <div id="last-called-holder">
                    <!-- JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- scripts -->
<script src="jquery-3.4.1.min.js"></script>
<script>
    var timer_update = null;
    var last_called = 0;
    $(document).ready(function() {
        var n = 0;
        var table = "";
        for (var i = 1; i < 91; i++) {
            if (i % 10 == 1) table += "<tr>";
            table += "<td><div class=\"number\" id=\"number-" + i + "\">" + i + "</div></td>";
            if (i % 10 == 0) table += "</tr>";
        }
        startUpdate();
        $('#tavola').html(table);
        $('#btnCall').click(function() {
            $.getJSON('edit.php?action=estrai', function(res) {
                if (res.ok == 0) {
                    printNum(res.data.last_called.toString(), '#last-called-holder', 'big-number');
                    $('#number-' + res.data.last_called).addClass('called');
                    last_called = res.data.last_called;
                } else {
                    console.log(res.msg);
                    if (res.ok == 2) alert('Tabellone pieno: resettalo!');
                }
            });
        });
        $('#btnReset').click(function() {
            $('.number').removeClass('called');
            $('#last-called-holder').html('');
            $.getJSON('edit.php?action=reset');
        });
        $('#btnRefresh').click(function() {
            if ($(this).data('state') == 'on') {
                $(this).html('Aggiornamento automatico: off');
                $(this).data('state', 'off');
                clearInterval(timer_update);
            } else {
                $(this).html('Aggiornamento automatico: on');
                $(this).data('state', 'on');
                startUpdate();
            }
        });
    });
    function startUpdate() {
        timer_update = setInterval(function() { 
            $.getJSON('edit.php?action=getinfo', function(res) {
                if (res.data.last_called != last_called) {
                    if (res.data.last_called == -1) $('#btnReset').trigger('click');
                    $.each(res.data.called_list, function(pos, num) {
                        $('#number-' + num).addClass('called');
                    });
                    $('#last-called-holder').html('');
                    for (var i = res.data.called_list.length - 4; i < res.data.called_list.length; i++) {
                        if (i >= 0) {
                            printNum(res.data.called_list[i].toString(), '#last-called-holder', 'big-number');
                        }
                    }
                    last_called = res.data.last_called;
                }
            });
        }, 1000);
    }
    function printNum(num, container_sel, items_sel) {
        var elem = '<div class="called-number"><div class="called-number-container">';
        if (num < 10) elem += '<div class="' + items_sel + ' n0"></div>';
        for (var i = 0; i < num.length; i++)
            elem += '<div class="' + items_sel + ' n' + num[i] + '"></div>';
        $(container_sel).prepend(elem + '</div></div>');
        if ($(container_sel + '> div').children().length > 4)
            $(container_sel + '> div').last().remove();
    }
</script>

</body>
</html>