$().ready(function () {
	//FORM CARD
	$("#run").click(function () {
		$("#card1").fadeIn(100).show();
			$("#card2").hide(5);
			$("#card3").hide();
	
	});
	$("#run2").click(function () {
			$("#card2").show();
			$("#card1").hide(5);
			$("#card3").hide();
		});
	$(".forgotBtn").click(function (argument) {
		$("#card2").hide();
		$("#card3").show();
	});
	//register form
	$("#register").click(function (e) {
		if ($("#formData")[0].checkValidity()) {
		e.preventDefault();
		if ($("#pas").val() != $("#cpas").val()) {
		$("#register").val("try again...");
		Msg = "<div class='alert alert-danger alert-dismissible'><button class='close' data-dismiss='alert'>&times</button><span><b>Oops! password donot match!</b></span></div>";
		$("#popMsg").html(Msg);
		} else{
		$.ajax({
			url:"includes/formval.in.php",
			type:"POST",
			data:$("#formData").serialize()+"&register=save",
			success: function (response) {
				 $("#register").val("sign up");
				if (response !== 'success') {
					$("#popMsg").html(response);
					
				} else{
					$("#popMsg").fadeToggle();
					$("#formData")[0].reset();
					Swal.fire({
						
						title: "registration successfull",
						icon: "success",
						text: "you are now a memeber...welcome please verify your account in your profile dashboard",
						//html: "<div class='spinner-border text-secondary' id='rol' role='status'><span class='sr-only'><p>loading</p></span></div>"
					});
					setTimeout(function () {
					window.location= "home.php"	
					}, 4000);
				} 
			}
		});	
		}
		}
		

	})
	//LOGIN FORM//***
	$("#login").click(function (e) {
		if ($("#formData2")[0].checkValidity()) {
		e.preventDefault();
		$("#login").val("please wait...");
		$.ajax({
			url:"includes/request.in.php",
			type:"POST",
			data:$("#formData2").serialize()+"&login=access",
			success:function (response) {
				$("#showMsg").html(response);
				$("#login").val("try agin");
				if (response === "success") {
					$("#showMsg").fadeToggle(2);
					$("#login").val("logging in...");
					setTimeout(function () {
					window.location= "home.php"	
					}, 1500);
				}
			}
		})	
		}
		
		
	});
	//forgot password oh jaa awara, ojoro.drare lifee is good,love nobody wurld,king of staten island,beamer
	$("#forgot").click(function (e) {
		if ($("#formData3")[0].checkValidity()) {
			e.preventDefault();
			$("#forgot").val("please wait...");
			$.ajax({
				url: "includes/forgo_t.php",
				type: "POST",
				data: $("#formData3").serialize()+ "&forgot=token",
				success:function (response) {
					$("#popMsg").html(response)
				}
			})
		}
	})
});