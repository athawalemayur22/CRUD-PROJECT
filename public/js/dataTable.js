var passwordReg =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
var emailRegEx = "^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$";
var phoneRegx = "^[7-9][0-9]{9}$";

function dataTable() {
    $("#example").DataTable({
      responsive: true,
      iDisplayLength: 25,
      order: [[1, "desc"]],
      columnDefs: [
        {
          targets: 0,
          orderable: false,
          className: 'text-center'
        },
        {
            targets: 1,
            className: 'text-center'
        },
        {
            targets: 2,
        },
        {
            targets: 3,
        },
        {
            targets: 4,
            className: 'text-center'
        },
        {
            targets: 5,
            orderable: false,
            className: 'text-center'
        },

        {
            targets: 6,
            orderable: false,
        },

        {
            targets: 7,
            orderable: false,
        },
        {
            targets: 8,
            orderable: false,
            className: 'text-center'
        },
        {
            targets: 9,
            orderable: false,
            className: 'text-center'
        },
       
      ],
      destroy: true,
      processing: true,
      serverSide: true,
      ajax: {
        type: "POST",
        url: baseUrl+"/tableData",
      },
    });
};

$(document).ready(function(){
    dataTable();
    // for Add
    $('#addBtn').click(function(){
        var formclone = $('#userDetails').clone();
        var dialog = bootbox.dialog({
            title: 'User Details',
            message : formclone.html(),
            buttons: {
                cancel: {
                    label: "Submit",
                    className: 'btn-primary',
                    callback: function(){

                        var data = new FormData();
                        var name = $(this).find('#name').val();
                        var email  = $(this).find('#email').val();
                        var phone = $(this).find('#phone').val();
                        var age = $(this).find('#age').val();
                        var male =  $(this).find('#male').prop("checked");
                        var female =  $(this).find('#female').prop("checked");
                        var gender = "";
                        if($(this).find('#male').prop("checked")){
                            var male = $(this).find('#male').val();
                            gender = male;
                        }
                        else{
                            var female = $(this).find('#female').val();
                            gender = female;
                        }
                        var address = $(this).find('#address').val();
                        var profileImage = $(this).find('#file').prop('files')[0];
                        data.append('name',name);
                        data.append('email',email);
                        data.append('phone',phone);
                        data.append('age',age);
                        data.append('gender',gender);
                        data.append('address',address);
                        data.append('image',profileImage.name);
                        
                        $(this).find('#nameError').text('');
                        $(this).find('#emailError').text('');
                        $(this).find('#phoneError').text('');
                        $(this).find('#ageError').text('');
                        $(this).find('#addressError').text('');

                        //for validations
                        if(name == ""){
                            $(this).find('#nameError').text('Enter your Name');
                            return false;
                        }
                        if(email == ""){
                            $(this).find('#emailError').text('Enter your Email');
                            return false;
                        }
                        if(!email.match(emailRegEx)){
                            $(this).find('#emailError').text('Enter correct Email Id');
                            return false;
                        }

                        if(phone == ""){
                            $(this).find('#phoneError').text('Enter your Phone Number');
                            return false;
                        }
                        if(!phone.match(phoneRegx)){
                            $(this).find('#phoneError').text('Enter valid mobile number');
                            return false;
                        }

                        if(age == ""){
                            $(this).find('#ageError').text('Enter your Age');
                            return false;
                        }

                        if(address == ""){
                            $(this).find('#addressError').text('Enter your Address');
                            return false;
                        }

                        $.ajax({
                            type : "POST",
                            url : baseUrl+'/addrecord',
                            dataType : 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            data : data ,
                            success : function(response){
                                if(response == true){
                                    bootbox.alert("data save successfully !");
                                    dataTable();
                                }
                                else{
                                    bootbox.alert("There is some issue to save data");
                                }
                            }
                        });
                    }
                },
            },
        });
    });
});
// For Edit
function edit(id){
    $.ajax({
        type : "POST",
        url : baseUrl+'/editrecord',
        dataType : 'JSON',
        data : {
            'id' : id
        },
        success : function(response){
        
            var id = response.id;
            var name = response.name;
            var email = response.email;
            var phone = response.phone;
            var age = response.age;
            var gender = response.gender;
            var address = response.address;

            var formclone = $('#userDetails').clone();
            formclone.find('#name').attr("value",name);
            formclone.find('#email').attr("value",email);
            formclone.find('#phone').attr("value",phone);
            formclone.find('#age').attr("value",age);
            formclone.find('#address').attr("value",address);
    
            if(gender == "male"){
                formclone.find('#male').attr("checked","checked");
            }
            else{
                formclone.find('#female').attr("checked","checked");
            }

            var dialog = bootbox.dialog({
                title: 'Edit user details',
                message: formclone.html(),
                buttons: {
                    cancel: {
                        label: "Submit",
                        className: 'btn-primary',
                        callback: function(){
                            var name = $(this).find('#name').val();
                            var email = $(this).find('#email').val();
                            var phone = $(this).find('#phone').val();
                            var age = $(this).find('#age').val();
                            var address = $(this).find('#address').val();


                            var male =  $(this).find('#male').prop("checked");
                            var female =  $(this).find('#female').prop("checked");
                            var gender = "";
                            if($(this).find('#male').prop("checked")){
                                var male = $(this).find('#male').val();
                                gender = male;
                            }
                            else{
                                var female = $(this).find('#female').val();
                                gender = female;
                            }


                            $.ajax({
                                type : "POST",
                                url : baseUrl+'/updaterecord',
                                dataType : 'JSON',
                                data : {
                                    'id' : id ,
                                    'name':name,
                                    'email':email,
                                    'phone':phone,
                                    'age':age,
                                    'gender':gender,
                                    'address':address,

                                },
                                success : function(response){
                                    if(response == true){
                                        dataTable();
                                        bootbox.alert({
                                            message : "Data edit successfully !"
                                        });
                                    }
                                }
                            });
                        }
                    },
                }
            });
        }
    });
}

// for delete
function deleteData(id){
    var dialog = bootbox.dialog({
        message: "<p>Confirm you want to delete this Record</p>",
        buttons: {
            cancel: {
                label: "Cancel",
                className: 'btn-danger',
                
            },
            ok: {
                label: "OK",
                className: 'btn-info',
                callback: function(){
                    $.ajax({
                        type : "POST",
                        url : baseUrl+'/deleterecord',
                        dataType : 'JSON',
                        data : {
                            'id' : id
                        },
                        success : function(response){
                            console.log(response);
                            dataTable();
                            bootbox.alert("Record Delete Successfully !");
                        }
                    });
                }
            }
        }
    });

}





    



