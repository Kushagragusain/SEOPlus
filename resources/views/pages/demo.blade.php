@extends('layouts.app')
@section('content')

    <input type="button" value="click" id="click">
@endsection
@section('footer')

<script>
    $('#click').click(function(){
        /*swal({
            title: "HTML <small>Title</small>!",
            text: 'A custom <span style="color:#F8BB86">html<span> message.',
            html: true,
        });*/
        swal(   {  title: "Edit Keyword",
                    //text: "Enter the keyword :",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputValue: 'hjghj',
                },
                function(inputValue){
                    if (inputValue === false)
                        return false;
                    if (inputValue === "") {
                        swal.showInputError("You need to write something!");
                        return false
                    }
                    //swal("Nice!", "You wrote: " + inputValue, "success");
                }
            );
    });
</script>
@endsection
