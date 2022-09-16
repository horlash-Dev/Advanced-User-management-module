$().ready(function () {

$("#login-admin").click(function (e) {
	if ($("#adminData")[0].checkValidity()) {
		e.preventDefault();
		$("#login-admin").val('please wait....');
		$.ajax({
			url:"php/admin_validity.php",
			method:"POST",
			data: $("#adminData").serialize()+"&adminDB=DBconnected",
			success:function (response) {
				//$(".message").html(response);
				if (response !== "admin-connected!") {
					$(".message").html(response);
					$("#login-admin").val("try again...");
				}else{
					$("#login-admin").val("logging in...");
					setTimeout(function () {
						window.location= "php/admin_dashboard.php";
					},1000);
			}
			}
		});
	}
});

	allUsers();
function allUsers() {
		$.ajax({
			url:"admin_validity.php",
			method:"POST",
			data: {admin_user: "Users-Data"},
			success:function (response) {
				$('#totalUser').html(response);
					$('table').DataTable();
			}
		});
}

//admin notification

	adminNotification();
function adminNotification(admin= "") {
		$.ajax({
			url:"admin_validity.php",
			method:"POST",
			data: {notify: admin},
			success:function (response) {
				   data = JSON.parse(response);
                  if (data.counter > 0) {
                    $('#alerticon').html(data.counter);
                  }

			}
		});
}

          // //notify
        $('body').on('click', '.alertbell', function () {
            $('#alerticon').html('');
            adminNotification('new');
        });
        //LOAD NOTIFCATION
            setInterval(function () {
              adminNotification();
            },20000);


//total post on  site

	allPost();
function allPost() {
		$.ajax({
			url:"admin_validity.php",
			method:"POST",
			data: {admin_user: "Users-POST"},
			success:function (response) {
				$('#totalPost').html(response);
					$('table').DataTable();
			}
		});
}

//total feedback on  site

	allfeedb();
function allfeedb() {
		$.ajax({
			url:"admin_validity.php",
			method:"POST",
			data: {admin_user: "Users-feedb"},
			success:function (response) {
				$('#totalFeedb').html(response);
					$('table').DataTable();
			}
		});
}

//toatl notifications

	allnotification();
function allnotification() {
		$.ajax({
			url:"admin_validity.php",
			method:"POST",
			data: {admin_user: "Users-notify"},
			success:function (response) {
				$('#totalnotification').html(response);
					$('table').DataTable();
			}
		});
}
//total user deleted

	alldeleted();
function alldeleted() {
		$.ajax({
			url:"admin_validity.php",
			method:"POST",
			data: {admin_user: "Users-Deleted"},
			success:function (response) {
				$('#totalDeleted').html(response);
					$('table').DataTable();
			}
		});
}

		
	//update user
	$("#AdminUt").click(function (e) {
		if ($("#adminData")[0].checkValidity()) {
			e.preventDefault();
			$("#AdminUt").val('please wait..');
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
				url: "admin_validity.php",
				method: "POST",
				data: $("#adminData").serialize()+"&usrUt=update",
				success:function (response) {
					if (response !== "admin-update-success!!") {
					$(".errMsg").html(response);
					$("#AdminUt").val('try agin...');	
				}else{
					$(".errMsg").html("");
						$("#AdminUt").val('upadte user info');
						$("#adminData")[0].reset();
						$("#adminModal").hide(0);
						Swal.fire({
							title: "updated succesfully",
							icon: "success",
							text: "dear admin you upadted user info!!",
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
	$('body').on("click", '.editData', function (e) {
		e.preventDefault();
		Updatedata= $(this).attr('id');
		$.ajax({
			url: "admin_validity.php",
			method: "POST",
			data: {admin_users: Updatedata},
			success:function (response) {
				myInfo= JSON.parse(response);
				$('#uid').val(myInfo['id']);
				$('#fsubject').val(myInfo['Fname']);
				$('#lsubject').val(myInfo['Lname']);
				$('#ursubject').val(myInfo['User']);
				$('#esubject').val(myInfo['Email']);
				$('#dsubject').val(myInfo['dob']);
				$('#vsubject').val(myInfo['verified']);
			}

		});
	})

	//reply feddback
	var uid;
	var fid;
	$('body').on("click", '.feedbData', function (e) {
		 uid= $(this).attr('id');
		 fid= $(this).attr('fid');
	})

	//feedback users

$("#addfeed").click(function (e) {
	if ($("#feedbData")[0].checkValidity()) {
		e.preventDefault();
		message = $("#feedbackdb").val();
		$('#addfeed').val('please wait....');
		$.ajax({
			url:"admin_validity.php",
			method:"POST",
			data: {id: uid, ids: fid, feedbackmsg: message},
			success:function (response) {
					if (response !=='admin-replied!') {
						$('#addfeed').val('try again...');
						$(".errClass").html(response);
					}else{$('#addfeed').val('send reply');
					$(".errClass").text('');
					$('#feedbData')[0].reset();
					$("#fdbmodal").hide();
					location.reload();
				}

			}
		});
	}
});
	
	//delete user
             $("body").on("click", ".delData", function(e) {
                 e.preventDefault();
                 del = $(this).attr('id');
                 Swal.fire({
                        title: "Are You Sure",
                        text: "You Want Delete This user",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "red",
                        cancelButtonColor:'blue',
                        confirmButtonText: "yes, delete it"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "admin_validity.php",
                    type: "POST",
                    data: {delNo:del},
                    success:function (response) {
                    	console.log(response);
                         Swal.fire({
                        title: "user deleted!",
                        showConfirmButton:false,
                        text: "dear admin you deleted a user",
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

             //delete notification
             $("body").on("click", ".notifyData", function(e) {
                 e.preventDefault();
                 delnot = $(this).attr('id');
                 Swal.fire({
                        title: "Are You Sure",
                        text: "You Want Delete This notification",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "red",
                        cancelButtonColor:'blue',
                        confirmButtonText: "yes, delete it"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "admin_validity.php",
                    type: "POST",
                    data: {delnotify:delnot},
                    success:function (response) {
                    	console.log(response);
                         Swal.fire({
                        title: "notification deleted!",
                        showConfirmButton:false,
                        text: "dear admin you deleted a notification",
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

             	//restore user
             $("body").on("click", ".restoreData", function(e) {
                 e.preventDefault();
                 res = $(this).attr('id');
                 Swal.fire({
                        title: "Are You Sure",
                        text: "You Want restore This user",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "green",
                        cancelButtonColor:'red',
                        confirmButtonText: "yes, restore it"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "admin_validity.php",
                    type: "POST",
                    data: {resNo:res},
                    success:function (response) {
                    	console.log(response);
                         Swal.fire({
                        title: "user restored!!",
                        showConfirmButton:false,
                        text: "dear admin you restored a user",
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

             //mute users
             $("body").on("click", ".muteData", function(e) {
                 e.preventDefault();
                 mute = $(this).attr('id');
                 Swal.fire({
                        title: "Are You Sure",
                        text: "You Want mute This user",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "green",
                        cancelButtonColor:'red',
                        confirmButtonText: "yes, mute user"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "admin_validity.php",
                    type: "POST",
                    data: {muteNo:mute},
                    success:function (response) {
                    	console.log(response);
                         Swal.fire({
                        title: "user muted!!",
                        showConfirmButton:false,
                        text: "dear admin you muted a user",
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

              //delete users post
             $("body").on("click", ".postdelData", function(e) {
                 e.preventDefault();
                 delpost = $(this).attr('id');
                 Swal.fire({
                        title: "Are You Sure",
                        text: "You Want delete This user post",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "green",
                        cancelButtonColor:'red',
                        confirmButtonText: "yes, delete user post"
                       }).then((result)=>{
                        if (result.value) {
                          $.ajax({
                    url: "admin_validity.php",
                    type: "POST",
                    data: {upost: delpost},
                    success:function (response) {
                    	console.log(response);
                         Swal.fire({
                        title: "user post deleted!!",
                        showConfirmButton:false,
                        text: "dear admin you deleted a user post",
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


             //admin-user info from db
               $("body").on("click", ".infoData", function (e) {
               e.preventDefault();
              infoNo = $(this).attr('id');
              $.ajax({
                url:"admin_validity.php",
                type:"POST",
                data:{usersinfo:infoNo},
                success:function (response) {
                  console.log(response);
                   data = JSON.parse(response);
                   Swal.fire({
                        title: '<h2>&nbsp;&nbsp;&nbsp;'+data['id']+'</h2>',
                        icon: "info",
                        html:'<div class="info"><i class="lead px-1">published on: ' +data['Fname']+'-- ' +data['Lname']+'</i><i class="lead px-1">edited on ' +data['Email']+'---' +data['User']+'</i><h4><i class="lead px-1">' +data['dob']+' ---' +data['verified']+'</i></h4></div>'

                       });
                  
                }
              })
            });

               //login data
               logintimeout();
                 function logintimeout() {
              $.ajax({
              url:"admin_validity.php",
                type:"POST",
                data: {expire: "login_expire"},
                success:function (response) {
                 // console.log(response);
                  $('#totallogin').html(response);
                  $('table').DataTable();
                }
              });
          }

             //load last_seen
              setInterval(function () {
              logintimeout();
            },20000);



});