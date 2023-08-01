<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chennai</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/68ee502f7d.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
        $("#starting").change(function(){
            var id=$('#starting').val();
            {

            $.ajax({
                url:'drop.php',
                type:'post',
                data:{ending_id:id},
                success:function(data){
                    $("#ending").html(data);
                }
            })
        }
              })
            })
  </script>
</head>
<body>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <h5 class="text-center text-capitalize">Transport form</h5>
            <form class="form" id="form" name="form" autocomplete="off">
            <input type="hidden" id="id" name="id" >

                <label for="name">
                    Name
                </label> 
                <input type="text" name="name" id="name" class="form-control name">      
                <label for="dob" class="mt-4">DOB</label>
                <input type="date" name="dob" class="form-control dob" id="dob">    
                <label class="mt-4" for="gender">Gender</label>
                <br>
                <input type="radio" class="gender" id="male" name="gender" value="male">
                <label for="male">Male</label> 
                <input type="radio"class="gender" id="female" name="gender" value="female">
                <label for="female">Female</label>
                <input type="radio" class="gender" id="others" name="gender" value="others">
                <label for="others">Others</label>
                <br>
                <label for="phone" class="mt-4">Phone</label>
                <input type="text" class="form-control phone" id="phone" name="phone" maxlength="10">
                <label for="email" class="mt-4">Email</label>
                <input type="email" class="form-control email" id="email" name="email">
                <label for="starting" class="mt-4">From</label>
                <select name="starting" id="starting" name="starting" class="form-control starting">
                    <option value="">--select from--</option>
                    <?php
                    session_start();
                    require 'dbcon.php';
                    $sql = "select * from starting";
                    $result = pg_query($sql);
                    while ($row = pg_fetch_assoc($result)){ ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['starting_place'];?></option>
                    <?php
                    }
                    ?>
                </select>
                <label for="ending" class="mt-4">To</label>
                <select name="ending" id="ending" class="form-control ending">
                    <option value="">--select to--</option>
                </select>
                <button class="btn btn-success submit mt-4" name="submit" type="button" id="submit">Submit</button>
                <button class="btn btn-success mt-4" name="update" style="display:none;" type="button" id="update">Update</button>

            </form>
        </div>
    </div>
</div>
<div class="json-table container-fluid mt-5">
    <table class="table table-bordered text-center text-capitalize" id="table">
        <tr class="text-primary">
            <th>id</th>
            <th>Name</th>
            <th>Dob</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>From</th>
            <th>To</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </table>
</div>
<script>
        //regex code for text & number
 $(document).on('keyup blur','#name',function(){
 $(this).val( $(this).val().replace(/[^A-Za-z ]/g,'') ); 
});
$(document).on('keyup blur','#phone',function(){
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
})

//On submit validation
$(document).on('click', "#submit", function() {
var Current_Field_id = $(this).attr('id');
try{
    if ($("#name").val().length == '') {
        throw {
            msg: "Enter your name",
            foc: "#name"
        }
    }
    if ($("#dob").val().length == '') {
        throw {
            msg: "Enter your date of birth",
            foc: "#dob"
        }
    }
if ($('input:radio[name=gender]:checked').length == 0)  {
        throw {
            msg: "select gender",
            foc: "#gender"
        }
    }

    if ($("#phone").val().length == '') {
        throw {
            msg: "Enter mobile number",
            foc: "#phone"
        }
    }

    if (!$('#phone').val().match('[6-9]{1}[0-9]{9}')) {

throw {
    msg: "Invald Mobileno",
    foc: "#phone"
}

}

if ($('#phone').val() === '6666666666' || $('#phone').val() === '7777777777'
|| $('#phone').val() === '8888888888' || $('#phone').val() === '9999999999') {
throw {
    msg: "Repated Numbers not allowed",
    foc: "#phone"
}
}

   if($('#email').val().length==""){
            throw{
                msg:'please enter email',
                foc:'#email'
            }
        }
        if(!$('#email').val().match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/)){
            throw {
                msg: "Enter valid Email",
                foc: "#email"
            }

        }
        if($('#starting').val().length==""){
            throw{
                msg: 'please choose From Place',
                foc: '#starting'
            }
        }
        if($('#ending').val().length==""){
            throw{
                msg: 'please choose To Place',
                foc: '#ending'
            }
        }

    $.ajax({
    url:'insert.php',
    type:'post',
    dataType:'html',
    data:$('#form').serialize(),
    success:function(s){
        alert(s);
    //   $('#data_table').load('#data_table');         
    }
  })
  
    return true;
}
catch(e){
    alert(e.msg);
    $(e.foc).focus();
} })
</script>

<!-- ajax fetch query -->

<script>
$(document).ready(function(){
$.ajax({
url:'fetch.php',
method:'post',
data:'json',
success:function(response){

  var data=JSON.parse(response);
  for(i in data){
    
     $("table").append( 
      "<tr id='"+data[i].id+"'><td>"+data[i].id+"</td>"
        +"<td>"+data[i].name+"</td>"
        +"<td>" +data[i].dob+"</td>"
        +"<td>" +data[i].gender+"</td>"
         +"<td>"+data[i].phone+"</td>"
         +"<td>" +data[i].email+"</td>"  
         +"<td>" +data[i].starting+"</td>" 
         +"<td>" +data[i].ending+"</td>"  
         +"<td>" +'<i class="fa-solid fa-pen-to-square text-warning" id="edit"></i>'+"</td>"  
         +"<td>" +'<i class="far fa-trash-alt text-danger remove" id="delete"></i>'+"</td></tr>"); 
        }       
  }
})
})

</script>

<!-- ajax delete query -->
<script>

 $(document).ready(function(){

$("#table").on('click','#delete',function(){
  var id = $(this).parents("tr").attr("id");


  if(confirm('Are you sure to remove this record ?'))
  { 
      $.ajax({
         url: 'delete.php',
         type: 'get',
         data: {id: id},
         error: function() {
            alert('Something is wrong');
         },
         success: function(data) {
            // alert(data)
              $("#"+id).remove();
              alert("Record removed successfully");  
         }
      });
 }
});
});

</script>

<!-- ajax edit -->
<script>

$(document).ready(function(){
$('#table').on('click','#edit',function(){
    var id = $(this).parents("tr").attr("id");

    if(confirm('Are you sure to edit this record ?'))
    { 
        $.ajax({
           url: 'edit.php',
           type: 'get',
           data: {id: id},
           error: function() {
              alert('Something is wrong');
           },
           success: function(response) {
             $('#submit').hide();
             $('#update').css('display','block');
            var data=JSON.parse(response);
            for(i in data){
               $('#id').val(data[i].id);
               $('#name').val(data[i].name);
               $('#dob').val(data[i].dob);
// gender edit
               if(data[i].gender=='male'){
                $("#male").prop("checked", true);
               }
               else if(data[i].gender=='female'){
                $("#female").prop("checked", true);
               }
               else{
                $("#other").prop("checked", true);
               }
// gender edit end
               $('#phone').val(data[i].phone);
               $('#email').val(data[i].email);
               $('#starting').val(data[i].starting);
            //    dependent edit
               $.ajax({
          url:'drop.php',
          type:'post',
          data:{ending_id:data[i].starting},
          success:function(res){
            $("#ending").html(res);//append option tag

               $('#ending').val(data[i].ending);

          }
        })
            }
            
}
        });

   }

})
 })

</script>

<!-- update ajax query -->

<script>
    $(document).ready(function(){
$('#update').click(function(){
    $.ajax({
    url:'update.php',
    type:'post',
    dataType:'html',
    data:$('#form').serialize(),
    success:function(s){
        alert(s);
      $('#form')[0].reset();  
      $('#submit').show();
      $('#update').css('display','none');         
    }
  });
});
});
</script>
</body>
</html>