
function get_bookings()
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/bookings.php", true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('table_data').innerHTML = this.responseText;
    }

    xhr.send('get_bookings');
}

let assign_room_form = document.getElementById('assign_room_form');


function assign_room(id){
    assign_room_form.elements['id']. value=id;
 }

 assign_room_form.addEventListener('submit',function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('room_no',assign_room_form.elements['room_no'].value);
    data.append('id',assign_room_form.elements['id'].value);
    data.append('assign_room', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/bookings.php",true);

    xhr.onload = function(){
        var myModal = document.getElementById('assign-room');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 1){
            alert('success','Room Number Alloted! Booking Finalized!');
            get_bookings();                       
        }
        else {
            alert('error','Server Down or Failed to Update!');
        }
    }

    xhr.send(data);
 });


 function cancel_booking(id)
 {
     if(confirm("Are you sure want to cancel this booking?"))
     {
         let data= new FormData();
         data.append('id',id);
         data.append('cancel_booking','');
 
         let xhr = new XMLHttpRequest();
         xhr.open("POST", "ajax/bookings.php", true);
 
         xhr.onload = function()
         {
             if(this.responseText == 1)
             {
                alert('success','Booking Removed');
                get_users();
             }
             else{
                 alert('error','Booking remove fail');
             }
         }
         xhr.send(data);
     }
     
 
 }

 function search_user(username)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('users-data').innerHTML = this.responseText;
    }

    xhr.send('search_user&name='+username);
}
 
window.onload =function(){
    get_bookings();
}

setInterval(get_bookings, 1000);

