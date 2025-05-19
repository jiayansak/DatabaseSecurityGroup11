
// let register_form = document.getElementById('register-form');

// register_form.addEventListener('submit', function(e){
//     e.preventDefault();
//     add_user();
// });

// function add_user() {
//     let data = new FormData(register_form);

//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/users.php", true);

//     xhr.onload = function() {
//         var myModal = document.getElementById('registerModal'); // Corrected ID
//         var modal = bootstrap.Modal.getInstance(myModal);
//         modal.hide();
// // Debugging output

//         if (this.responseText == 1) {
//             alert('success', 'New user added');
//             register_form.reset();
//             get_users();
//         } else {
//             alert('error', 'Failed, try again later');
//             register_form.reset();
//             get_users();
//         }
//     }


//     xhr.send(data);
// }








// function toggle_status(id,val)
// {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/users.php", true);
//     xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

//     xhr.onload = function(){
//         if(this.responseText==1)
//         {
//             alert('success','User Status Toggled!');
//             get_users();
//         }
//         else
//         {
//             alert('error','server down');
//         }
//     }

//     xhr.send('toggle_status='+id+'&value='+val);
// }

// function change_status(id,val)
// {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/users.php", true);
//     xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

//     xhr.onload = function(){
//         if(this.responseText==1)
//         {
//             alert('success','User Status Toggled!');
//             get_users();
//         }
//         else
//         {
//             alert('error','server down');
//         }
//     }

//     xhr.send('change_status='+id+'&value='+val);
// }


function remove_admin(sr_no)
{
    if(confirm("Are you sure want to delete admin?"))
    {
        let data= new FormData();
        data.append('sr_no',sr_no);
        data.append('remove_admin','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/admin.php", true);

        xhr.onload = function()
        {
            if(this.responseText == 1)
            {
                alert('success','Admin Removed');
                get_admin();
            }
            else{
                alert('error','Admin remove fail');
            }
        }
        xhr.send(data);
    }
    

}


function search_admin(adminname)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/admin.php", true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('admins-data').innerHTML = this.responseText;
    }

    xhr.send('search_admin&name='+adminname);
}




window.onload =function(){
    get_admin();
}


