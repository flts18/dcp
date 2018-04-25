function subject()
{
	
	var v=document.getElementById("sub").value;
	//alert(v);
	if(v=="others")
	{
	
		document.getElementById("sub_div").style.display="block";
		document.getElementById("add_sub").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_div").style.display="none";
		document.getElementById("add_sub").disabled = true;
	}
}

function desig()
{
	//alert("hello");
	var v=document.getElementById("designation").value;
	if(v=="others")
	{
	
		document.getElementById("sub_desig").style.display="block";
		document.getElementById("add_desig").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_desig").style.display="none";
		document.getElementById("add_desig").disabled = true;
	}
}

function add_section()
{
	//alert("hello");
	var v=document.getElementById("section").value;
	if(v=="others")
	{
	
		document.getElementById("sub_sec").style.display="block";
		document.getElementById("add_sec").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_sec").style.display="none";
		document.getElementById("add_sec").disabled = true;
	}
}

function category_Others()
{
	
	var v=document.getElementById("category").value;
	if(v=="category_Others")
	{
	
		document.getElementById("sub_div2").style.display="block";
		document.getElementById("add_cat").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_div2").style.display="none";
		document.getElementById("add_cat").disabled = true;
	}
}

function add_authority()
{
	
	var v=document.getElementById("authority").value;
	
	if(v=="add_authority_name")
	{
	
	
	document.getElementById("sub_div1").style.display="block";
		document.getElementById("add_authority_name").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_div1").style.display="none";
		document.getElementById("add_authority_name").disabled = true;
	}
}
// $(document).ready(function() {
//     $(".add_letter_button").click(function(e){ 
//         e.preventDefault();
//             $(".input_letter_wrap").append('<div class="form-group"><label>Corespondance Page</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="remove_field" style="color:blue;cursor:pointer">Remove</label><input type="file" class="form-control" id="letterfile" name="letterfile[]"></div>'); 
        
//     });
    
//     $(".input_letter_wrap").on("click",".remove_field", function(e){ 
//         e.preventDefault(); $(this).parent('div').remove();
//     })
// });

// $(document).ready(function() {
//     $(".add_doc_button").click(function(e){ 
//         e.preventDefault();
//             $(".input_doc_wrap").append('<div class="form-group"><label>Corespondance Page</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="remove_field" style="color:blue;cursor:pointer">Remove</label><input type="file" class="form-control" id="docfile" name="docfile[]"></div>'); 
        
//     });
    
//     $(".input_doc_wrap").on("click",".remove_field", function(e){ 
//         e.preventDefault(); $(this).parent('div').remove();
//     })
// });

// For more page and letter count attach upload
var a=1;
$(document).ready(function() {

    $(".add_letter_button").click(function(e){ 
        e.preventDefault();
		a++;
		$(".input_letter_wrap").append('<div class="form-group"><label for="letterfile" class="inc1">&nbsp;&nbsp;&nbsp;&nbsp;Letter Page '+ a +'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="remove_field" style="color:blue;cursor:pointer">Remove</label><input type="file" class="form-control" id="letterfile" name="letterfile[]"></div>'); 
        
    });
    
    $(".input_letter_wrap").on("click",".remove_field", function(e){ 
	var lin1;var b=0;
	e.preventDefault(); $(this).parent('div').remove();
		$( ".inc1" ).each(function( iv ) {
	    b++;
		lin1='&nbsp;&nbsp;&nbsp;&nbsp;Letter Page '+ b;
		$( this ).html(lin1) ;
       });
	   a= b;
    })
});
// For more page docs count attach upload
var x=1;
$(document).ready(function() {

    $(".add_doc_button").click(function(e){ 
        e.preventDefault();
		x++;
		$(".input_doc_wrap").append('<div class="form-group"><label for="docfile" class="inc2">&nbsp;&nbsp;&nbsp;&nbsp;Document Page '+ x +'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="remove_field" style="color:blue;cursor:pointer">Remove</label><input type="file" class="form-control" id="docfile" name="docfile[]"></div>'); 
        
    });
    
    $(".input_doc_wrap").on("click",".remove_field", function(e){ 
	var lin2;var y=0;
	e.preventDefault(); $(this).parent('div').remove();
		$( ".inc2" ).each(function( iv ) {
	    y++;
		lin2='&nbsp;&nbsp;&nbsp;&nbsp;Document Page '+ y;
		$( this ).html(lin2) ;
       });
	   x= y;
    })
});


// For letter count upload
var i=1;
$(document).ready(function() {

    $(".add_letter_field_button").click(function(e){ 
        e.preventDefault();
		i++;
		$(".input_letter_fields_wrap").append('<div class="form-group"><label for="userfile" class="inc">Upload Page '+ i +'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="remove_field" style="color:blue;cursor:pointer">Remove</label><input type="file" class="form-control" id="userfile" name="userfile[]"></div>'); 
        
    });
    
    $(".input_letter_fields_wrap").on("click",".remove_field", function(e){ 
	var lin;var j=0;
	e.preventDefault(); $(this).parent('div').remove();
		$( ".inc" ).each(function( iv ) {
	    j++;
		lin='Upload Page '+ j;
		$( this ).html(lin) ;
       });
	   i= j;
    })
});


function k_show()
{
	
	var v=document.getElementById("show_key").checked;
	if(v)
	{
		document.getElementById("skey").style.display="block";
	}
	else
	{
		document.getElementById("skey").style.display="none";
		
	}
}

function upper_str(v)
{
	
	v.value = v.value.toUpperCase();
}

// autocomplet : 
function autocomplet() {
	var min_length = 0; 
	var csrf_test_name=$("input[name=csrf_test_name]").val();
	var keyword = $('#authority').val();
	var base_url=$("#base_url").val();
	var url=base_url+"letter_registration/search_authority/";
	if (keyword.length >min_length) {
		$.ajax({
			url: url,
			type: 'POST',
			data: {keyword:keyword,csrf_test_name:csrf_test_name},
			success:function(data){
				$('#authority_list').show();
				$('#authority_list').html(data);
			}
		});
	} else {
		$('#authority_list').hide();
	}
}

function set_item(id,item) 
{
	//alert(id);
	$('#authority').val(item);
	$('#authority_id').val(id);
	$('#authority_list').hide();
	search_authority();

}


function search_authority()
{
	
	var v=document.getElementById("authority_id").value;
	if(v=="add_authority_name")
	{
	document.getElementById("sub_div1").style.display="block";
    document.getElementById("add_authority_name").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_div1").style.display="none";
		document.getElementById("add_authority_name").disabled = true;
	}
}

function action_type()
{
	
	var v=document.getElementById("actionable_id").value;
	if(v=="Actionable")
	{
	document.getElementById("act_type").style.display="block";
	document.getElementById("act_dt").style.display="block";
    //document.getElementById("add_authority_name").disabled = false;
		
	}
	else
	{
		document.getElementById("act_type").style.display="none";
		document.getElementById("act_dt").style.display="none";
		//document.getElementById("add_authority_name").disabled = true;
	}
}

function action_text()
{
	
	var v=document.getElementById("others").checked;
	
	if(v)
	{
	document.getElementById("act_text").style.display="block";
    ///document.getElementById("act_name").disabled = false;
		
	}
	else
	{
		document.getElementById("act_text").style.display="none";
		//document.getElementById("act_name").disabled = true;
	}
}

$(document).ready(function(){
    $(".flip").click(function(){
    var idd='#shpanel'+this.id.slice(4);
      $('.shpanel').not($(idd)).slideUp(800);
		$(idd).slideToggle();
		 // $(idd).scrollTo($(idd).right,$(idd).bottom);
        //$('html,body').animate({scrollTop: $(this).offset().top}, 800); 
    });
});

 $('.datepicker').datepicker({
    dateFormat: "dd/mm/yy",
   changeMonth: true,
   changeYear: true,


})

// autocomplet search key for attach letter to file
function autocomplet_search_key() {
	var min_length = 0; 
	var keyword = $('#search_file').val();
	var base_url=$("#base_url").val();
	var csrf_test_name=$("input[name=csrf_test_name]").val();
	var url=base_url+"letter_to_file/search_file/";
	if (keyword.length >min_length) {
		$.ajax({
			url: url,
			type: 'POST',
			data: {keyword:keyword,csrf_test_name:csrf_test_name},
			success:function(data){
				$('#file_list').show();
				$('#file_list').html(data);
			}
		});
	} else {
		$('#authority_list').hide();
	}
}

function set_file(id,item) 
{
	//alert(id);
	$('#search_file').val(item);
	$('#fileid').val(id);
	$('#file_list').hide();
	

}


function rcolor(id) 
{
	//alert(id);
	sessionStorage.setItem("co",id);
	$('#'+id).css({"background-color":"#FFFF4C","box-shadow":"0px 0px 10px #0000ff","-webkit-box-shadow": "0px 0px 10px #0000ff","-moz-box-shadow": "0px 0px 30px #0000ff"});

 
}

function getcolor() 
{
	//alert(localStorage.co);
	if(sessionStorage.co!="")
	{
	$('#'+sessionStorage.co).css({"background-color":"#FFFF4C"," box-shadow":"0px 0px 10px #0000ff","-webkit-box-shadow": "0px 0px 10px #0000ff","-moz-box-shadow": "0px 0px 30px #0000ff"});

	}

}


// notification  for actionable letter 
var cn=0;
function notifcation() 
{
	//alert('ok')
	var csrf_test_name=$("input[name=csrf_test_name]").val();
	var site_url=$("#site_url").val();
	var url=site_url+"home_controller/action_notifcation/";
		$.ajax({
			url: url,
			type: 'POST',
			data: {csrf_test_name:csrf_test_name},
			success:function(data){
				$('#nc').html(data);
				if(cn==0)
				{
					cn=$("#c").val();
					//$('#sound').html('<audio autoplay="autoplay"><source src="'+site_url+'/style/images/m.mp3" type="audio/mpeg" /></audio>');
				}
				var c=$("#c").val();
				if(c>cn)
                 {
                    cn=c;
				    $('#sound').html('<audio autoplay="autoplay"><source src="'+site_url+'/style/images/m.mp3" type="audio/mpeg" /></audio>');
			     }
			}
		});
   setTimeout(function() {notifcation(); }, 5000);
	
}
notifcation(); 
getcolor();
$(document).ready(function(){
 $(".datepicker").attr("placeholder", "DD/MM/YY");
 $(".datepicker").attr('readonly', true);
})