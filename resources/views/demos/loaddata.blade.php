
@section('title',"Load More Data Demo -")

@section('meta','ShareurCodes is a code sharing site for programmers to learn, share their knowledge with younger generation')

@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="title-color text-center"><u>Load More Data Demo</u></h3>
    </div>

</div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1 " id="load-data" >
            @foreach($activities as $activity)
            <div class="mdl-grid mdl-cell mdl-cell--12-col  mdl-shadow--4dp">
            <div class="post">
                <a href=""  class="nounderline" ><h2 class="post-title" >{{ $activity->title }}</h2></a>
                <div class="row">
                   <div class="col-md-6">
                       <h5 class="post-date" >Published: {{ date('M j, Y', strtotime($activity->created_at)) }}</h5>
                   </div>
               </div>
                <div class="row">

                    <div class="col-md-8">
                        <p class="text-justify">{{substr(strip_tags($activity->details,'<pre>,<code>'),0,500) }}{{ strlen(strip_tags($activity->details))>500?"...":"" }}</p>
                    </div>
                </div>
            </div>

            </div>
            @endforeach

            <div id="remove-row">
                <button id="btn-more" data-id="{{ $activity->id }}" class="nounderline btn-block mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" > Load More </button>
            </div>


        </div>


    </div>


@stop

@section('scripts')

<script>

$(document).ready(function(){
   $(document).on('click','#btn-more',function(){
       var id = $(this).data('id');
       $("#btn-more").html("Loading....");
       $.ajax({
           url : '{{ url("demos/loaddata") }}',
           method : "POST",
           data : {id:id, _token:"{{csrf_token()}}"},
           dataType : "text",
           success : function (data)
           {
              if(data != '')
              {
                  $('#remove-row').remove();
                  $('#load-data').append(data);
              }
              else
              {
                  $('#btn-more').html("No Data");
              }
           }
       });
   });
});
</script>

@stop
