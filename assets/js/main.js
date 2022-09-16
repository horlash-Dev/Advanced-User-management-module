 $(document).ready(function() {
            
            //select data from db
             SelectData();
            function SelectData() {
                $.ajax({
                    url: "classes/view.class.php",
                    type: "POST",
                    data: {info: "show"},
                    success:function (response) {
                     $("#displayUser").html(response);
                      $("table").DataTable();
                      
                    }
                });
            }
           
            //insert into db
            $("#insert").click(function(e) {
                if ($("#formData")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                    url: "classes/view.class.php",
                    type: "POST",
                    data: $("#formData").serialize()+"&input=show",
                    success:function (response) {
                       Swal.fire({
                        title: "user added to DB",
                        icon: "success"

                       })
                       ///$("#hui").html(response);
                       $("#showModal").modal('hide');
                       $("#formData")[0].reset();
                       SelectData();
                    }
                });       
                }
            });
            //edit options

            $("body").on("click", ".editBtn", function (e) {
               e.preventDefault();
              editNo = $(this).attr('id');
              $.ajax({
                url:"classes/view.class.php",
                type:"POST",
                data:{edit: editNo},
                success:function (response) {
                   //$("#hui").html(response); 
                   data = JSON.parse(response);
                   $("#ids").val(data['id']);
                   $("#fname").val(data['Fname']);
                   $("#lname").val(data['Lname']);
                   $("#mail").val(data['Email']);
                   $("#user").val(data['User']);
                }
              })
            });
            //update link
             $(".updat").click(function(e) {
                if ($("#formData2")[0].checkValidity()) {
                    e.preventDefault();
                     Swal.fire({
                        title: "Are You Sure",
                        text: "You Want Update This file",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "skyblue",
                        cancelButtonColor:'red',
                        confirmButtonText: "yes update it"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "classes/view.class.php",
                    type: "POST",
                    data: $("#formData2").serialize()+"&input=update",
                    success:function (response) {
                       Swal.fire({
                        title: "file updated in DB",
                        icon: "success"
                       })
                      //$("#hui").html(response);
                       $("#showModal2").modal('hide');
                       $("#formData2")[0].reset();
                       SelectData();
                    }
                });         
                        }
                       }) 
                    
                }
            });

             //delete item
             $("body").on("click", ".delBtn", function(e) {
                 e.preventDefault();
                 del = $(this).attr('id');
                 Swal.fire({
                        title: "Are You Sure",
                        text: "You Want Delete This file",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "red",
                        cancelButtonColor:'blue',
                        confirmButtonText: "yes delete it"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "classes/view.class.php",
                    type: "POST",
                    data: {delNo:del},
                    success:function (response) {
                         Swal.fire({
                        title: "deleted!",
                        text: "file deleted",
                        icon: "success"
                    })
                        SelectData();
                    }
                });         
                    }
               }) 

             })
             //info from db
               $("body").on("click", ".infoBtn", function (e) {
               e.preventDefault();
              infoNo = $(this).attr('id');
              $.ajax({
                url:"classes/view.class.php",
                type:"POST",
                data:{info:infoNo},
                success:function (response) {
                 // $("#hui").html(response);
                  //console.log(response);
                   data = JSON.parse(response);
                   Swal.fire({
                        title: '<h2>user details (' +data['id']+')</h2>',
                        icon: "info",
                        html:'<div class="info"><h4> ID <i class="lead"> (:0' +data['id']+'</i></h4><h4>full name: <i class="lead">' +data['Fname'] + data['Lname']+'</i></h4><h4>firstname: <i class="lead">' +data['Fname']+'</i></h4><h4>lastname:<i class="lead px-1">' +data['Lname']+'</i></h4><h4>username: <i class="lead px-1">' +data['User']+'</i></h4><h4>email -: <i class="lead px-1">' +data['Email']+'</i></h4></div>'

                       });
                  
                }
              })
            });

        });