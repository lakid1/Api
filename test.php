<!doctype html>
<html lang="en">

<head>
  <title>Test</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
</head>

<body>

  <!-- Optional JavaScript -->
  <form action="#" id="rezervaceForm">
    <p>Datum příjezdu: </p>
    <input id="ar_date" type="date" name="ar_date">
    <p>Datum odjezdu: </p>
    <input id="le_date" type="date" name="le_date">
  </form>
  <button id="submit">Odeslat</button>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script>
    $('#submit').click(function () {
      var date = $('#ar_date').val();
      var month = new Array();
      month[0] = 1;
      month[1] = 2;
      month[2] = 3;
      month[3] = 4;
      month[4] = 5;
      month[5] = 6;
      month[6] = 7;
      month[7] = 8;
      month[8] = 9;
      month[9] = 10;
      month[10] = 11;
      month[11] = 12;
      var d = new Date();
      var t = d.getFullYear() + "-" + month[d.getMonth()] + "-" + d.getDate();
      var date2 = $('#le_date').val();


      if((date < t)||(date2 < date))
      {
          alert("Nesprávný formát data");
      }else{
          $('#rezervaceForm').submit();
      }
    });

  </script>
</body>

</html>
