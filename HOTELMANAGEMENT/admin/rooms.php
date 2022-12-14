<?php
  require('extra/func.php');
  require('extra/connect.php');
  adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms</title>
    <?php require('extra/links.php'); ?>

</head>


<body style="color:rgb(37, 22, 4) ; background-color:rgb(243, 228, 210);">

 <?php require('extra/header.php'); ?>
 
  <div class="container-fluid">
    <div class="row">
      <div class="col-10 ms-auto p-4 ">
        <h2 class="mb-2 fs-3">ROOMS</h2>


        <!-- Rooms Settings -->
        
        <div class="card shadow border-0 mb-4">
          <div class="card-body">
            <div class="text-end mb-3">
                <button type="button" class="btn btn-dark btn-small shadow-none" data-bs-toggle="modal" data-bs-target="#roomsSettings">
                <i class="bi bi-person-plus-fill"></i> Add
                </button>
              </div>

            <div class="table-responsive" style="height: 500px;overflow-y:scroll;">
                <table class="table table-hover border border-4 border-light">
                  <thead>
                    <tr class="bg-dark text-white">
                      <th scope="col">No.</th>
                      <th scope="col">Name</th>
                      <th scope="col">Area</th>
                      <th scope="col">Price</th>
                      <th scope="col">Quantity</th> <!-- how many rooms of each type available -->
                      <th scope="col">Guests</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="rooms-data">
                  </tbody>
                </table>
            </div>   
          </div>
        </div>
      </div>
  </div>
</div>
 
<!-- Rooms Add -->

<div class="modal fade" id="roomsSettings" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

      <form id="roomsSettings_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bolder">Add Rooms</h5>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Name</label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Area</label>
                <input type="number" name="area" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Price</label>
                <input type="number" name="price" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Quantity</label>
                <input type="number" name="quantity" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Adults(Max)</label>
                <input type="number" name="adult" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Children(Max)</label>
                <input type="number" name="children" class="form-control shadow-none" required>
              </div>
              <div class="col-12 mb-4">
                <label class="form-label fw-bolder">Features</label>
                <div class="row">
                  <?php 
                    $res = selectAll('features');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"
                        <div class='col-3 mb-1'>
                          <label> 
                            <input type='checkbox' name='features' value='$opt[feature_ID]' class='form-check-input shadow-none'>
                            $opt[name]
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-4">
                <label class="form-label fw-bolder">Facilities</label>
                <div class="row">
                  <?php 
                    $res = selectAll('facilities');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"
                        <div class='col-3 mb-1'>
                          <label> 
                            <input type='checkbox' name='facilities' value='$opt[facilities_ID]' class='form-check-input shadow-none'>
                            $opt[name]
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bolder">About Room</label>
                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
              </div>
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="submit"  class="btn btn-light shadow-none" style="background-color: rgb(97, 226, 183);">Submit</button>
            <button type="reset" class="btn btn-danger shadow-none" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
      
    </div>
</div>

<!-- Rooms Edit -->

<div class="modal fade" id="editRoom" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

      <form id="editRooms_form">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bolder">Edit Rooms</h5>
          </div>

          <div class="modal-body">
            <div class="row">
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Name</label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Area</label>
                <input type="number" name="area" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Price</label>
                <input type="number" name="price" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Quantity</label>
                <input type="number" name="quantity" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Adults(Max)</label>
                <input type="number" name="adult" class="form-control shadow-none" required>
              </div>
              <div class="col-6 mb-3">
                <label class="form-label fw-bolder">Children(Max)</label>
                <input type="number" name="children" class="form-control shadow-none" required>
              </div>
              <div class="col-12 mb-4">
                <label class="form-label fw-bolder">Features</label>
                <div class="row">
                  <?php 
                    $res = selectAll('features');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"
                        <div class='col-3 mb-1'>
                          <label> 
                            <input type='checkbox' name='features' value='$opt[feature_ID]' class='form-check-input shadow-none'>
                            $opt[name]
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-4">
                <label class="form-label fw-bolder">Facilities</label>
                <div class="row">
                  <?php 
                    $res = selectAll('facilities');
                    while($opt = mysqli_fetch_assoc($res)){
                      echo"
                        <div class='col-3 mb-1'>
                          <label> 
                            <input type='checkbox' name='facilities' value='$opt[facilities_ID]' class='form-check-input shadow-none'>
                            $opt[name]
                          </label>
                        </div>
                      ";
                    }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bolder">About Room</label>
                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
              </div>
              <input type="hidden" name="room_ID">
            </div>
          </div>
          
          <div class="modal-footer">
            <button type="submit"  class="btn btn-light shadow-none" style="background-color: rgb(97, 226, 183);">Submit</button>
            <button type="reset" class="btn btn-danger shadow-none" data-bs-dismiss="modal">Cancel</button>
          </div>
        </div>
      </form>
      
    </div>
</div>

<!-- Rooms Images -->

<div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Room Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="pb-3 mb-3">
          <form id="add_image_form">
            <label class="form-label fw-bolder">Add Image</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png, .svg" class="form-control shadow-none mb-3" required>
            <button class="btn btn-light shadow-none" style="background-color: rgb(97, 226, 183);">ADD</button>
            <input type="hidden" name="room_id">
          </form>
        </div>

        <div class="table-responsive" style="height: 350px;overflow-y:scroll;">
                <table class="table table-hover border border-4 border-light">
                  <thead>
                    <tr class="bg-dark text-white">
                      <th scope="col" width="60%">Image</th>
                      <th scope="col">Thumbnail</th>
                      <th scope="col">Delete</th>
                      
                    </tr>
                  </thead>
                  <tbody id="room-image-data">
                  </tbody>
                </table>
        </div> 
      </div>
    </div>
  </div>
</div>






<?php require('extra/scripts.php'); ?>

<script>
  

  let roomsSettings_form = document.getElementById('roomsSettings_form');
  
  
  // Rooms Fetch

  roomsSettings_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_rooms();
   });

   function add_rooms(){   
    let data = new FormData(); 

    data.append('add_rooms','');
    data.append('name',roomsSettings_form.elements['name'].value); 
    data.append('area',roomsSettings_form.elements['area'].value); 
    data.append('price',roomsSettings_form.elements['price'].value); 
    data.append('quantity',roomsSettings_form.elements['quantity'].value); 
    data.append('adult',roomsSettings_form.elements['adult'].value); 
    data.append('children',roomsSettings_form.elements['children'].value); 
    data.append('desc',roomsSettings_form.elements['desc'].value); 
     
    let features = [];

    roomsSettings_form.elements['features'].forEach(el =>{ //foreach traverses array
      if(el.checked){
        console.log(el.value);
        features.push(el.value);
      }
    });

    let facilities = [];

    roomsSettings_form.elements['facilities'].forEach(el =>{ //foreach traverses array
      if(el.checked){
        console.log(el.value);
        facilities.push(el.value);
      }
    });

    data.append('features',JSON.stringify(features)); //convert to array
    data.append('facilities',JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);

    xhr.onload = function(){

      var myModal = document.getElementById('roomsSettings');
      var modal = bootstrap.Modal.getInstance(myModal); 
      modal.hide();

      if(this.responseText == 1){
          console.log('New room added');
          roomsSettings_form.reset();
          get_rooms();
        }
        else{
          console.log('Room adding failed!');
        }   
    }

    xhr.send(data);
   }

   function get_rooms(){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      document.getElementById('rooms-data').innerHTML = this.responseText;
    }

    xhr.send('get_rooms');
   }

   let editRooms_form = document.getElementById('editRooms_form');
   
   function edit_rooms(id){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      let data = JSON.parse(this.responseText);

      editRooms_form.elements['name'].value = data.roomdata.name;
      editRooms_form.elements['area'].value = data.roomdata.area;
      editRooms_form.elements['price'].value = data.roomdata.price;
      editRooms_form.elements['quantity'].value = data.roomdata.quantity;
      editRooms_form.elements['adult'].value = data.roomdata.adult;
      editRooms_form.elements['children'].value = data.roomdata.children;
      editRooms_form.elements['desc'].value = data.roomdata.description;
      editRooms_form.elements['room_ID'].value = data.roomdata.id;

      editRooms_form.elements['features'].forEach(el =>{
        if(data.features.includes(Number(el.value))){
          el.checked = true;
        }
      });
      
      editRooms_form.elements['facilities'].forEach(el =>{
        if(data.facilities.includes(Number(el.value))){
          el.checked = true;
        }
      });

        
    }

    xhr.send('get_one_room='+id);

   }

   editRooms_form.addEventListener('submit',function(e){
      e.preventDefault();
      submit_edit_room();
   });

   function submit_edit_room(){   
    let data = new FormData(); 

    data.append('submit_edit_room','');
    data.append('room_ID',editRooms_form.elements['room_ID'].value);
    data.append('name',editRooms_form.elements['name'].value); 
    data.append('area',editRooms_form.elements['area'].value); 
    data.append('price',editRooms_form.elements['price'].value); 
    data.append('quantity',editRooms_form.elements['quantity'].value); 
    data.append('adult',editRooms_form.elements['adult'].value); 
    data.append('children',editRooms_form.elements['children'].value); 
    data.append('desc',editRooms_form.elements['desc'].value); 
     
    let features = [];

    editRooms_form.elements['features'].forEach(el =>{ //foreach traverses array
      if(el.checked){
        console.log(el.value);
        features.push(el.value);
      }
    });

    let facilities = [];

    editRooms_form.elements['facilities'].forEach(el =>{ //foreach traverses array
      if(el.checked){
        console.log(el.value);
        facilities.push(el.value);
      }
    });

    data.append('features',JSON.stringify(features)); //convert to array
    data.append('facilities',JSON.stringify(facilities));

    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    

    xhr.onload = function(){

      var myModal = document.getElementById('editRoom');
      var modal = bootstrap.Modal.getInstance(myModal); 
      modal.hide();

      if(this.responseText == 1){
          console.log('Room edited!');
          editRooms_form.reset();
          get_rooms();
        }
        else{
          console.log('Room editing failed!');
        }   
    }

    xhr.send(data);
   }

   function toggle_status(id,val){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      if(this.responseText == 1){
          console.log('Status Changed');
          get_rooms();
        }
        else{
          console.log('Status Changing Failed!');
        }  
    }

    xhr.send('toggle_status='+id+'&value='+val);
   }

   let add_image_form = document.getElementById('add_image_form');

   add_image_form.addEventListener('submit',function(e){
      e.preventDefault();
      add_image();
   });

   function add_image(){

    let data = new FormData(); 
    data.append('image',add_image_form.elements['image'].files[0]);
    data.append('room_id',add_image_form.elements['room_id'].value); 
    data.append('add_image',''); 

    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    

    xhr.onload = function(){

      if(this.responseText == 'inv_img'){
        console.log("inv_img");
        }
        else{
         console.log('Image added');
         room_images(add_image_form.elements['room_id'].value,document.querySelector("#room-images .modal-title").innerText);
         add_image_form.reset();
        }   
    }
   
     xhr.send(data);

   }

   function room_images(id,rname){
    document.querySelector("#room-images .modal-title").innerText = rname;
    add_image_form.elements['room_id'].value = id;
    add_image_form.elements['image'].value = '';

    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

    xhr.onload = function(){
      document.getElementById('room-image-data').innerHTML = this.responseText;
    }

    xhr.send('get_room_images='+id);
   }

   function rem_image(img_id,room_id){
    let data = new FormData(); 
    data.append('image_id',img_id);
    data.append('room_id',room_id); 
    data.append('rem_image',''); 

    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    

    xhr.onload = function(){

      if(this.responseText == 1){
        console.log('Image deleted');
        room_images(room_id,document.querySelector("#room-images .modal-title").innerText);
        }
        else{
          console.log('Image not deleted');
        }   
    }
   
     xhr.send(data);


   }

   function thumb_image(img_id,room_id){
    let data = new FormData(); 
    data.append('image_id',img_id);
    data.append('room_id',room_id); 
    data.append('thumb_image',''); 

    let xhr = new XMLHttpRequest();
    xhr.open("POST","fetch/rooms_fetch.php",true);
    

    xhr.onload = function(){

      if(this.responseText == 1){
        console.log('Image thumbnail changed');
        room_images(room_id,document.querySelector("#room-images .modal-title").innerText);
        }
        else{
          console.log('Image thumbnail not changed');
        }   
    }
   
     xhr.send(data);


   }

   function remove_room(room_id){
    if(confirm("Do you want to delete this room?")){
      let data = new FormData();
      data.append('room_id',room_id); 
      data.append('remove_room',''); 

      let xhr = new XMLHttpRequest();
      xhr.open("POST","fetch/rooms_fetch.php",true);
      

      xhr.onload = function(){

      if(this.responseText == 1){
        console.log('Room deleted');
        get_rooms();
        }
        else{
          console.log('Room not deleted');
        }   
      }
      
        xhr.send(data);

    }
   }


  
















   window.onload = function(){
    get_rooms();
   }



</script>

</body>
</html>