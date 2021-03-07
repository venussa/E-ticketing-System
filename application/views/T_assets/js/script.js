
	// 
	var active_url 		= $(".active-url").val();
	var active_table 	= $(".active-table").val();

	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();

	$(document).ready(function(){

		load_table(1);

		$(".img-background").css({
			"height" : $(window).height()+"px"
		});

		var height  = $(".panel-login").height();
		var windows = $(window).height();
		var get_height = windows - height;
		var get_margin = get_height / 2;

		$(".margin-login").css({
			"margin-top" : (get_margin-250)+"px"
		});

		var sidebar = $("#sidebar-wrapper").width();
		$(".page-content").css({
			"width" : ($(window).width() - sidebar - 40)+"px",
			"margin-left" : (sidebar + 20)+"px"
		});

		 $('#browsebutton :file').change(function(e){
            var fileName = e.target.files[0].name;
            $("#label").attr('placeholder',fileName)
        });

		$("#play").click();

		$("body").fadeIn();

	});


	function load_table(id){

		if($.isNumeric(id) == true){

			var num_page = id;

		}else if($(id).attr("page") == false){

			var num_page = $(id).val();

		}else{

			var num_page = $(id).attr("page");

		}


		$.ajax({

			type	 : "POST",
			url 	 : active_url+""+active_table,
			data	 : {
				page 		: num_page,
				dataperpage : $("#dataperpage").val(),
				keyword 	: $("#search").val()
			},
			success	 : function(event){

				$("#table-result").html(event);

			}

		});

		return false;

	}

	function hapus(id,page = 1){

		if(confirm("Are you sure ? ") == true){
			$.ajax({

			type	 : "POST",
			url 	 : active_url+"handler",
			data 	 : {
				action  : "2",
				id 		: id
			} ,
			success	 : function(event){

				load_table(page);

			}

		});
		}

	}

	function show_notification(a){

			$.ajax({

				type : "POST",
				url  : active_url+"handler",
				data : {
					action  : "7",
				} ,
				success : function(event){
					$("#alerts").hide();
					window.location = $(a).attr("url");
				}
			});



	}

	function ticket_status(a){

		$.ajax({

			type : "POST",
			url  : active_url+"handler",
			data : {
				action  : "1",
				id 		: $(a).attr("data")
			} ,
			success : function(event){

				if(event.indexOf("<on/>") !== -1){

					$(a).attr("status","on");
					$(a).animate({
						"margin-left" : "0px"
					});

				}else if(event.indexOf("<off/>") !== -1){

					$(a).attr("status","off");
					$(a).animate({
						"margin-left" : "-50px"
					});

				}else{

					alert("failed");

				}

			},
			error : function(){

					alert("failed");				

			}

		});
	}

	function pay_status(a){

		$.ajax({

			type : "POST",
			url  : active_url+"handler",
			data : {
				action  : "5",
				id 		: $(a).attr("data")
			} ,
			success : function(event){

				if(event.indexOf("<on/>") !== -1){

					$(a).attr("status","on");
					$(a).animate({
						"margin-left" : "0px"
					});

					$("#status-"+$(a).attr("data")).html("Sudah Dibayar");

				}else if(event.indexOf("<off/>") !== -1){

					$(a).attr("status","off");
					$(a).animate({
						"margin-left" : "-50px"
					});

				}

			},
			error : function(){

					alert("failed");				

			}

		});
	}

	function add_ticket(id){

		if(id == 1){
			
			$(".page-space").load(active_url+"add-ticket");
			$(".table-ticket").hide();

		}else{

			$(".page-space").html("");
			$(".table-ticket").show();

		}
		
		
	}

	function load_time(){


		$('.timepicker').timepicker({
		    timeFormat: 'H:mm',
		    interval: 15,
		    defaultTime: '7',
		    dynamic: false,
		    dropdown: true,
		    scrollbar: true
		});

		$( ".datepicker" ).datepicker();

	}

	function save_ticket(id){

		$.ajax({

			type : $(id).attr("method"),
			url  : $(id).attr("action"),
			data : new FormData(id),
			contentType: false,
			cache: false,
			processData:false,
			beforeSend : function(){
				$("button").attr("disabled","true");
				$("input").attr("disabled","true");
				$("textarea").attr("disabled","true");
			},
			success : function(event){
				$("button").removeAttr("disabled");
				$("input").removeAttr("disabled");
				$("textarea").removeAttr("disabled");
				load_table(1);
				$(".page-space").html("");
				$(".table-ticket").show();
			}
		});

		return false;

	}

	function save_setting(id){

		$.ajax({

			type : $(id).attr("method"),
			url  : $(id).attr("action"),
			data : $(id).serialize(),
			beforeSend : function(){
				$("button").html("Saving ...");
				$("button").attr("disabled","true");
				$("input").attr("disabled","true");
				$("textarea").attr("disabled","true");
			},
			success : function(event){
				$("button").removeAttr("disabled");
				$("input").removeAttr("disabled");
				$("textarea").removeAttr("disabled");
				$("button").html("Save Setting");

				if(event.indexOf("<passfail/>") !== -1){

					$(".alert").hide();
					$(".old").show();

				}else if(event.indexOf("<newpassfail/>") !== -1){

					$(".alert").hide();
					$(".new").show();

				}else if(event.indexOf("<failchangepass/>") !== -1){

					$(".alert").hide();
					$(".other").show();

				}else if(event.indexOf("<success/>") !== -1){

					$(".alert").hide();
					$(".ook").show();
					$("input[type='password']").val('');

				}else{

					$(".alert").hide();
					$(".other").show();

				}
			}
		});

		return false;

	}


	function login(id){

		$.ajax({

			type : $(id).attr("method"),
			url  : $(id).attr("action"),
			data : $(id).serialize(),
			beforeSend : function(){
			
			},
			success : function(event){
				if(event.indexOf("<nouser/>") !== -1){

					$(".alert").hide();
					$(".user").fadeIn();

				}else if(event.indexOf("<nopass/>") !== -1){

					$(".alert").hide();
					$(".pass").fadeIn();

				}else if(event.indexOf("<success/>") !== -1){

					$(".alert").hide();
					$(".success").fadeIn();

					delay(function(){

						window.location = "../adminpanel/dashboard";

					},2000);

				}
			}
		});

		return false;
	}

	function reply_msg(a){

		$.ajax({

			type : "POST",
			url  : active_url+"handler",
			data : $(a).serialize(),
			beforeSend : function(){
				$("input").attr("disabled","true");
				$("textarea").attr("disabled","true");
				$(".btn-reply").attr("disabled","true");
				$(".btn-reply").html("Mengirim ...");
			},
			success : function(event){

				if(event.indexOf("<yes/>") !== -1){

					load_table(1);
					$(".page-space").html("");
					$(".table-ticket").show();

				}else{
					alert("failed");
				}
				
			}

		});

		return false;
	}

	function add_form_reply(id){

		if($(".table-ticket").css("display") == "none"){
			
			$(".page-space").html("");
			$(".table-ticket").show();

		}else{

			$(".page-space").load(active_url+"reply?id="+$(id).attr("data"));
			$(".table-ticket").hide();

		}
		
		
	}

	function activate(a){

             $.ajax({
                type    : "POST",
                url     : active_url+"handler",
                data    : {
                    id : a,
                    action : "10"
                },
                beforeSend : function(){
                	$(".load-"+a).show();
                	$(".img-"+a).hide();
                },
                success : function(event){

                	$(".load-"+a).hide();
                	$(".img-"+a).show();

                    if(event.indexOf("<active/>") !== -1){

                        $(".box-theme").css({

                            "border"  : "1px #ddd solid"

                        });

                         $(".box-"+a).css({

                            "border"  : "3px green solid"

                        });

                         $(".img-check").attr("src",$(".img-check").attr("data2"));
                         $(".img-"+a).attr("src",$(".img-check").attr("data1"));


                    }else if(event.indexOf("<nonactive/>") !== -1){

                         $(".box-theme").css({

                            "border"  : "1px #ddd solid",

                        });

                         $(".img-check").attr("src",$(".img-check").attr("data2"));

                    }

                }

            });

    }

    function delete_theme(a){

    	if(confirm("Are you sure ?")){

	    	$.ajax({
	               
	            type    : "POST",
	            url     : active_url+"handler",
	            data    : {
	                id : a,
	                action : "12"
	            },
	            success : function(event){

	            	if(event.indexOf("<done/>") !== -1){
	            		
	            		$(".cont-"+a).remove();

	            	}
	            }

	        });

	   }

    }


    function edit_theme(a){

    	if($("#theme-edit").css("display") == "none"){
	    	$.ajax({
		               
		            type    : "POST",
		            url     : active_url+"theme-setting",
		            data    : {
		                id : a
		            },
		            success : function(event){
		            	$("#theme-edit").html(event);
		            	$("#theme-edit").show();
		            	$("#theme-list").hide();
		            }

		        });
	    }else{

	    	$("#theme-edit").html("");
	    	$("#theme-edit").hide();
		    $("#theme-list").show();

	    }
    }

    function readURL(input) {

	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $($(".preview-"+$(input).attr("name"))).attr('src', e.target.result);
	    }

	    reader.readAsDataURL(input.files[0]);
	  }
	}

	function select_img(a){

		$("#"+$(a).attr("data")).click();

	}

	function save_set_theme(a){

		$.ajax({
			type : $(a).attr("method"),
			url  : $(a).attr("action"),
			data : new FormData(a),
			contentType: false,
			cache: false,
			processData:false,
			beforeSend : function(){
				$("#btn-save").attr("disabled","true");
				$("#btn-save").html("Menyimpan ...");
				$("input").attr("disabled","true");
				$("textarea").attr("disabled","true");
			},
			success : function(event){

				if(event.indexOf("<yes/>") !== -1){
					$("#btn-save").removeAttr("disabled");
					$("#btn-save").html("Simpan");
					$("input").removeAttr("disabled");
					$("textarea").removeAttr("disabled");
					$(".alert").hide();
					$(".yes").show();
				}else{
					$("#btn-save").removeAttr("disabled");
					$("#btn-save").html("Simpan");
					$("input").removeAttr("disabled");
					$("textarea").removeAttr("disabled");
					$(".alert").hide();
					$(".no").show();
				}

			}
		});

		return false;
	}