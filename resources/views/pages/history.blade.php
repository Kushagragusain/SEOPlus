@extends('layouts.app', ['link' => 'Add URL'])
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
@section('content')
<div class="container">
    <div class="card">

  <div id="showtable" class="text-center">
      gdfgdfbdf
                                </div>




</div>


</div>
@endsection
@section('footer')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>


            <script>
                $(document).ready(function(){
                    //load url history on page load
                    $('#contents').load('history #url_data', function(){
                        $('#url_data').css('display', 'block');
                    });

                    //load url history on clicking urls
                    $('#url_history').click(function(){
                        $('#contents').load('history #url_data', function(){
                            $('#url_data').css('display', 'block');
                        });
                        $("#url_history").css('color', 'red');
                        $("#keyword_history").css('color', 'blue');
                    });

                    //load keyword history on clicking keywords
                    $('#keyword_history').click(function(){
                        $('#contents').load('history #keyword_data', function(){
                            $('#keyword_data').css('display', 'block');
                        });
                        $("#keyword_history").css('color', 'red');
                        $("#url_history").css('color', 'blue');
                    });1
                });
            </script>


  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function() {
      var url = "{{ URL::to('/historyfetch') }}";
      $('#showtable').html("<div style=\"cursor: pointer;\">Toggle column: <a class=\"toggle-vis\" data-column=\"0\">S.No</a> - <a class=\"toggle-vis\" data-column=\"1\">Website</a>- <a class=\"toggle-vis\" data-column=\"2\">Rank</a>  - </div><div class=\"table-responsive\"><table id=\"example\" class=\"table table-hover table-banded\" cellspacing=\"0\" width=\"100%\"><thead ><tr ><th>S.No</th><th>Website</th><th>Rank</th></tr></thead><tbody></tbody></table></div>");
           var table = $('#example').DataTable({
                responsive: true,
               "ajax": url,
               "columns": [
                    { "data": "sno" },
                   { "data": "website" },
                    { "data": "rank" },
                    ]
               });
            $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
    } );

} );
  </script>

@endsection






