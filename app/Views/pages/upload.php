<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- <img src="<?='uploads/'?>" alt="" style:"width:50px;height:50px"> -->

    <form action="<?= base_url('image')?>" method="POST" enctype="multipart/form-data">
         <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>