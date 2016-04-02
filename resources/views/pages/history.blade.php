@extends('layouts.app', ['link' => 'Add URL'])
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
@section('content')
<div class="container">
<div class="card">
    <div class="card-header bgm-blue m-b-20">



                                    <h2>History<small>Previous Searches</small></h2>

                                </div>



    <div class="card-body p-10 p-b-0">
                                       <div class="table-responsive">
     <table id="example" class="display" cellspacing="0" width="100%">
     @if($urls->count() == 0)
        No searches
    @else
        <thead>
            <tr>
                <th>Id</th>
                <th>Website</th>
                <th>Rank</th>

            </tr>
        </thead>

        <tbody>
             @foreach($urls as $i)

                <tr>
                <td>{{ $i->id }}</td>
                <td><a href="url_rank/{{ $i->id }}" >{{ $i->url }}</a></td>
                <td>{{ $i['alexa_rank'] }} </td>

                </tr>
            @endforeach
        </tbody>
     @endif
    </table>

                    </div>
                                </div>
                            </div>

</div>
@endsection
@section('footer')

            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
    $('#example').DataTable();
} );
  </script>

@endsection






