<?=$this->extend('layout/main')?>

<?= $this->section('mainbody-section')?>
<div class="col-12">

<div class="container  mt-5">
    <a href="javascript:void(0);" class="btn btn-success mb-3" id="addBtn">Add</a>

    <form class="d-none" id="userDetails" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name<span class="text-danger d-inline">*</span></label>
            <input type="text" class="form-control" id="name" name="username">
            <small id="nameError" class="text-danger"></small>
        </div>

        <div class="form-group">
            <label for="email">Email address<span class="text-danger d-inline">*</span></label>
            <input type="email" class="form-control" id="email" name="useremail">
            <small id="emailError" class="text-danger"></small>
        </div>

        <div class="form-group">
            <label for="phone">Phone<span class="text-danger d-inline">*</span></label>
            <input type="number" class="form-control" id="phone" name="userphone">
            <small id="phoneError" class="text-danger"></small>
        </div> 

        <div class="form-group">
            <label for="age">Age<span class="text-danger d-inline">*</span></label>
            <input type="number" class="form-control" id="age" name="userage">
            <small id="ageError" class="text-danger"></small>
        </div> 
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
            <label class="form-check-label" for="male">
                Male
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
            <label class="form-check-label" for="female">
                Female
            </label>
        </div>

        <div class="form-group">
            <label for="address">Address<span class="text-danger d-inline">*</span></label>
            <input type="text" class="form-control" id="address" placeholder="Enter your address">
            <small id="addressError" class="text-danger"></small>
        </div>

        <div class="form-group">
            <label for="file">Upload File<span class="text-danger d-inline">*</span></label>
            <input type="file" class="form-control-file" id="file" name="file">
        </div>
    </form>

    <table id="example" class="display responsive nowrap" style="width:100%">
       <thead>
           <tr>
               <th>Edit</th>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Age</th>
               <th>Gender</th>
               <th>Address</th>
               <th>Image</th>
               <th>Delete</th>
           </tr>
       </thead>
    </table>
</div>
</div>

<?= $this->endSection() ?>




