<?php
  require_once __DIR__ . '/functions.php'; 

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>raspistill web</title>

    <link href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./vendor/seiyria/bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="./main.css" rel="stylesheet">


    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">

      <div class="page-header">
        <h1>Raspistill web</h1>
        <p class="lead">Simple web interface to raspistill command utility</p>
      </div>
      <div class="messages"></div>
      <div class="row">
        <div class="col-md-6">
          <img src="" id="preview" class="img-thumbnail img-responsive">
        </div>
        <div class="col-md-6">
          <form class="form-horizontal" id="settings-form">
            <?php
              foreach(PARAMETERS as $p)
                getParameterHtml($p);
            ?>
            <hr>
            <div class="text-right">
              <button type="submit" class="btn btn-primary" id="btn-take-picture" data-loading-text="<i class='icon-spinner icon-spin icon-large'></i> Wait...">Take picture</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="./vendor/components/jquery/jquery.min.js"></script>
    <script src="./vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./vendor/seiyria/bootstrap-slider/dist/bootstrap-slider.min.js"></script>
    
    <script>
      $(function(){
        $('input.slider').slider({
          formatter: function(value) {
            return 'Current value: ' + value;
          }
        });
        $('#settings-form').submit(function(e) {
          e.preventDefault();
          $('#btn-take-picture').button('loading');
          $('.messages').hide().empty();

          $.ajax({
            dataType: 'json',
            data: $(this).serialize(),
            method: "GET",
            cache: false,
            url: './handler.php'
          }).done(function(data) {
            if (data.status == 'ok') {
              $('#preview').attr('src', data.picture);
            } else {
              $('.messages').append('<p class="bg-danger text-danger">' + data.error + '</p>').show();
            }
          }).fail(function( jqXHR, textStatus ) {
            $('.messages').append('<p class="bg-danger text-danger">Unable to take picture</p>').show();
          }).always(function() {
            $('#btn-take-picture').button('reset');
          });
        });

      });
    </script>
  </body>
</html>