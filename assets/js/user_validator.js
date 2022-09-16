$().ready(function () {
	userDisplay();
	$("#addStory").click(function (e) {
		if ($("#formDatas")[0].checkValidity()) {
			e.preventDefault();
			$("#addStory").val('please wait..');
			$.ajax({
				url: "includes/validity.in.php",
				method: "POST",
				data: $("#formDatas").serialize()+"&addStory=subject",
				success:function (response) {
					if (response !== 'success-user') {
						$(".errClass").html(response);
						$("#addStory").val('try again...');
					}else{
						$(".errClass").html("");
						$("#addStory").val('add story');
						$("#formDatas")[0].reset();
						$("#addModal").modal('hide');
						Swal.fire({
							title: "your story was added succesfully",
							icon: "success",
							text: "dear user you added a new story",
							showConfirmButton:false
						});
						setTimeout(function () {
              			location.reload()
              		},1000);
					}
				}

			})
		}
		
	});

	//update timeline
	$("#Ustory").click(function (e) {
		if ($("#formData2")[0].checkValidity()) {
			e.preventDefault();
			$("#Ustory").val('please wait..');
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
				url: "includes/validity.in.php",
				method: "POST",
				data: $("#formData2").serialize()+"&upStory=update",
				success:function (response) {
					if (response !== "info-updated") {
					$(".errMsg").html(response);
					$("#Ustory").val('try agin...');	
				}else{
					$(".errMsg").html("");
						$("#Ustory").val('upadte timeline');
						$("#formData2")[0].reset();
						$("#addModal2").modal('hide');
						Swal.fire({
							title: "your story was updated succesfully",
							icon: "success",
							text: "dear user you upadted your story",
							showConfirmButton:false
						});
					setTimeout(function () {
              			location.reload()
              		},1000);
				} 
					
				}

			});
                }
                   });
			
		}
		
	});

	//update fetching
	$('body').on("click", '.editBtn', function (e) {
		e.preventDefault();
		Updatedata= $(this).attr('id');
		$.ajax({
			url: "includes/validity.in.php",
			method: "POST",
			data: {fetch: Updatedata},
			success:function (response) {
				myInfo= JSON.parse(response);
				$('#uid').val(myInfo['id']);
				$('#tsubject').val(myInfo['subject']);
				$('#ttext').val(myInfo['timeline']);
			}

		});
	})

	//select all
	function userDisplay() {
		selno= $('#selection').val();
		$.ajax({
			url: "includes/validity.in.php",
			method: "POST",
			data: {display: selno},
			success:function (response) {
				$(".content-item").html(response);
			}
		});
	}

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
                        confirmButtonText: "yes, delete it"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "includes/validity.in.php",
                    type: "POST",
                    data: {delNo:del},
                    success:function (response) {
                    	console.log(response);
                         Swal.fire({
                        title: "story deleted!",
                        showConfirmButton:false,
                        text: "dear user you deleted a story",
                        icon: "success"
                    });
                        setTimeout(function () {
              			location.reload()
              		},1000);
                    }
                });         
                    }
               }); 
             });

             //info from db
               $("body").on("click", ".infoBtn", function (e) {
               e.preventDefault();
              infoNo = $(this).attr('id');
              $.ajax({
                url:"includes/validity.in.php",
                type:"POST",
                data:{info:infoNo},
                success:function (response) {
                  console.log(response);
                   data = JSON.parse(response);
                   Swal.fire({
                        title: '<h2>&nbsp;&nbsp;&nbsp;'+data['subject']+'</h2>',
                        icon: "info",
                        html:'<div class="info"><i class="lead px-1">published on: ' +data['created_at']+'</i><i class="lead px-1">edited on ' +data['update_at']+'</i><h4><i class="lead px-1">' +data['timeline']+'</i></h4></div>'

                       });
                  
                }
              })
            });
         ////update image users info
         $("#userData").submit(function (e) {
         		e.preventDefault();
         		$("#fileSubmit").val("please wait...");
         		$.ajax({
         		 url:"../../includes/validity.in.php",
                type:"POST",
                processData:false,
                contentType:false,
                cache:false,
                data: new FormData(this),
                success:function (response) {
                	$("#Err").html(response);
                	if (response !== "profile updated") {
                		$("#fileSubmit").val("try again...");
                	}else{$("#Err").text("");$("#fileSubmit").val("updating....");
                	setTimeout(function () {
              			location.reload()
              		},2000);}
                }
         		});
         	
         });
          ////update profile users info
          $("#userData1").submit(function (e) {
          	if ($("#userData1")[0].checkValidity()) {
          		e.preventDefault();
          		$("#profileUP").val("please wait...");
          		$.ajax({
          		url:"../../includes/validity.in.php",
                type:"POST",
              	data: $("#userData1").serialize()+"&info=profileupdt",
              	success:function (response) {
              		$("#Err").html(response);
              		$("#profileUP").val("try again...");
              		if (response === "profile succesfully updated") {
              		$("#Err").text("");
              		$("#profileUP").val("updating...");
              		setTimeout(function () {
              			location.reload()
              		},2000);
              		
              		}
              	}
                
          		});
          	}
          });

          ///change password
          $("#userData2").submit(function (e) {
          	if ($("#userData2")[0].checkValidity()) {
          		e.preventDefault();
          		$("#passSubmit").val("please wait...");
          		if ($("#newpass").val() != $("#ucpass").val()) {
          			$("#passSubmit").val("try again...");
          			msg= "<b class='text-danger'>*confirm password donot match</b>";
          			$("#Error").html(msg);
          		}else{
          		$.ajax({
          		url:"../../includes/validity.in.php",
                type:"POST",
              	data: $("#userData2").serialize()+"&changep=password",
              	success:function (response) {
              		$("#Error").html(response);
              		$("#passSubmit").val("try again...");
              		if (response === "password changed") {
              		$("#Error").text("");
              		$("#passSubmit").val("updating...");
              		setTimeout(function () {
              			location.reload()
              		},2000);
              		
              		}
              	}
                
          		});
          		}
          	}
          });

          //email verify
          $("#mailVerify").click(function (e) {
          	e.preventDefault();
          	$("#mailVerify").text("please wait....");
          	$.ajax({
          		url:"../../includes/mailer.php",
                type:"POST",
                data:{email: "verify"},
                success:function (response) {
                	$("#info").html(response);
                	$("#mailVerify").text("verify now");
                }
          	});
          });
          //feed message
          $("#feedStory").click(function (e) {
          	
          	if ($('#feedback')[0].checkValidity()) {
          		e.preventDefault();
          		$(this).val("please wait...");
          			$.ajax({
          		url:"../../includes/validity.in.php",
                type:"POST",
              	data: $("#feedback").serialize()+"&feed=feedback",
              	success:function (response) {
              		$("#errors").html(response);
              		$('#feedStory').val("try again...");
              		if (response === "feedback sent") {
              		$("#errors").text("");
              		$('#feedStory').val("sending...");
              		Swal.fire({
							title: "message sent",
							icon: "success",
							showConfirmButton:false
						});
              		setTimeout(function () {
              			location.reload()
              		},1000);
              		
              		}
              	}
                
          		});
          	}
          });
          ////notifications
          userNotification();
          function userNotification(user= '') {
          		$.ajax({
          		url:"../../includes/validity.in.php",
                type:"POST",
              	data: {notify: user},
              	success:function (response) {
              		console.log(response);
                  data = JSON.parse(response);
              		$('#notifications').html(data.newnotification);
                  if (data.counter > 0) {
                    $('#alerticon').html(data.counter);
                  }
              		
              	}
              });
          }
          // //notify
        $('body').on('click', '.alertbell', function () {
            $('#alerticon').html('');
            userNotification('new');
        });
        //LOAD NOTIFCATION
            setInterval(function () {
              userNotification();
            },20000);

            //login timeout
            logincheck();
             function logincheck() {
              $.ajax({
              url:"../../includes/validity.in.php",
                type:"POST",
                data: {timesout: "login_check"},
                success:function (response) {
                  //console.log(response);
                  
                }
              });
          }   
          //load last_seen
              setInterval(function () {
              logincheck();
            },20000);

              //timeout for all
                          
            logout();
             function logout() {
              $.ajax({
              url:"../../includes/validity.in.php",
                type:"POST",
                data: {logout: "logout_check"},
                success:function (response) {
                  //console.log(response);
                  if (response === 'logout_success') {
                      window.location= '../../index.php';
                  }
                }
              });
          }   
          //load logout...
              setInterval(function () {
              logout();
            },20000);

});
