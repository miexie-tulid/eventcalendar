<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
<link rel='stylesheet' href='css/bootstrap-colorpicker.css' />
<div class="container-fluid pt-5  pb-5">
  <div class="row"><div class="col-12"><h3>Event Calendar By Miexie Tulid</h3></div></div>

  <div class="row">
    <div class="col-3">
 <form action="{{ route('events.store') }}" method="post">
  {{ csrf_field() }}
  <strong>Event Name:</strong>
  <br />
  <input type="text" name="name" />
  <br /><br />
  <strong>Start Date:</strong>
  <br />
  <input type="text" name="from_date" class="date" />
   <br /><br />
  <strong>End Date:</strong>
  <br />
  <input type="text" name="to_date" class="date" />
  <br /><br />
  <strong>Days:</strong>
  <br /><input type="checkbox" name="selected_days[]"  value="Mon"> Monday
  <br /><input type="checkbox" name="selected_days[]"  value="Tue"> Tuesday
  <br /><input type="checkbox" name="selected_days[]"  value="Wed"> Wednesday
  <br /><input type="checkbox" name="selected_days[]"  value="Thu"> Thursday
  <br /><input type="checkbox" name="selected_days[]"  value="Fri"> Friday
  <br /><input type="checkbox" name="selected_days[]"  value="Sat"> Saturday
  <br /><input type="checkbox" name="selected_days[]"  value="Sun"> Sunday
  <br /><br />
  <strong>Colour:</strong>
  <br />
  <input type="text" name="colour" class="colour"  /> 
  <br /><br />
  <input type="submit" value="Save" />
</form>
    </div>
    <div class="col-9">


        <div id='calendar'></div>
    </div>
  </div>

</div>


<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/bootstrap-colorpicker.js"></script>
<script>
    $(document).ready(function() {
		
		
        // page is now ready, initialize the calendar...
        $('#calendar').fullCalendar({
            // put your options and callbacks here
			header: {
        		left: 'prev,next today',
        		center: 'title',
        		right: 'month,agendaWeek,agendaDay'
    			},
    		defaultView: 'month',
            events : [
			   
@foreach($events as $event)
	@php
 		$date_from = strtotime($event->from_date); 
 		$date_to = strtotime($event->to_date);
        $selected_days = json_decode($event->selected_days);    
	@endphp
  
	@for($i=$date_from; $i<=$date_to; $i+=86400)
       @php  
         $curdate = date("Y-m-d", $i); 
         $dayOfWeek  = date("D", $i);
       @endphp
     
     @if(in_array($dayOfWeek,$selected_days))
      {
                    title : '{{ $event->name }}',
                    start : '{{ $curdate }}',
					overlap: true,
					backgroundColor: '{{ $event->colour }}',
					borderColor: '{{ $event->colour }}',
                    url : '{{ route('events.edit', $event->id) }}'
       },
     @endif
	 
	@endfor  
@endforeach


            ]
        });
		
		
		
	  //initialise date picker	
	  $('.date').datepicker({
        autoclose: true,
        dateFormat: "yy-mm-dd"
      });
	  
	  
	  //initialise color picker
	  $(".colour").colorpicker();
	  
	
		
    });
	
	
	
</script>