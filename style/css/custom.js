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
function check_addr_Ext(){

	if(document.getElementById("addr_ext").checked == true){
		document.getElementById("addr_desig").style.display="none";
		document.getElementById("recip_no").style.display="block";
		document.getElementById("designation").disabled = true;
        document.getElementById("section").disabled = true;
		

	}
	else{
		document.getElementById("addr_desig").style.display="block";
		document.getElementById("recip_no").style.display="none";
		document.getElementById("recip_no").disabled = true;
		document.getElementById("designation").disabled = false;
		document.getElementById("section").disabled = false;
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

function receivertype(v,cls,id1,id2)
{
	
	if(document.getElementById(v).checked == true)
	{
		
		$(cls).css({'display':'block'});	
		$(cls).css({'disabled':'false'});	
		document.getElementById(id1).disabled = false;
		document.getElementById(id2).disabled = false;
		//document.getElementById(cls).disabled = false;
	 //$(v).css({'display':'none'});											
		//document.getElementById("addr-to").style.display="block";
		//document.getElementById("designation").disabled = false;
		//document.getElementById("extrnal-org").style.display="none";
		
         // document.getElementById("user_id").disabled = false;
		
		
	}
	else
	{
		$(cls).css({'display':'none'});	
		$(cls).css({'disabled':'true'});
		document.getElementById(id1).disabled = true;
		document.getElementById(id2).disabled = true;
		/* document.getElementById("receiver_name").disabled = true;
        document.getElementById("receiver_address").disabled = true; */
		/* $('.addr-to').css({'display':'none'});	
		$('.extrnal-org').css({'display':'block'});
		//document.getElementById("addr-to").style.display="none";
		document.getElementById("designation").disabled = true;
		document.getElementById("user_id").disabled = true;
		//document.getElementById("section").disabled = true;
		
		 document.getElementById("receiver_name").style.display="block";
		  document.getElementById("receiver_address").style.display="block";
		  document.getElementById("receiver_address").disabled = false;
		 document.getElementById("receiver_name").disabled = false; */
	}
}

//extension check

function check_double_ext(){
    //alert("okk");
    var name=document.getElementById("letterfile").value;
    //alert(name);
      var str_name=name.split(".");
      //return confirm("Do want to change File name?");
      if(str_name.length==2){
        if(str_name[1].toUpperCase() !='pdf'.toUpperCase()){
          document.getElementById("letterfile").value="";
          alert("Please select pdf file only.");

        }
      }
      else{
        document.getElementById("letterfile").value="";
         alert("Wrong file!");
      }
     
  }
  //restrict spcial chars
$("#nsp").on('keyup', function(e) {
    var val = $(this).val();
   if (val.match(/[^a-zA-Z0-9]/g)) {
       $(this).val(val.replace(/[^a-zA-Z0-9]/g, ''));
   }
});

//for only alpha in section insert
$("#sec_name").on('keyup', function(e) {
    var val = $(this).val();
   if (val.match(/[^a-zA-Z -]/g)) {
       $(this).val(val.replace(/[^a-zA-Z -]/g, ''));
   }
});

$("#sec_code").on('keyup', function(e) {
    var val = $(this).val();
   if (val.match(/[^a-zA-Z]/g)) {
       $(this).val(val.replace(/[^a-zA-Z -]/g, ''));
   }
});

function add_section()
{
	
	//sub_section();
	var v=document.getElementById("section").value;
	//alert(v);
	if(v=="others")
	{
		document.getElementById("subsec").style.display="none";
		document.getElementById("subsec_list").style.display="none";
        document.getElementById("subsec_list").disabled = true;
		document.getElementById("sub_sec").style.display="block";
		document.getElementById("add_sec").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_sec").style.display="none";
		document.getElementById("add_sec").disabled = true;
	}
}

function add_letter_reg()
{
	
	//sub_section();
	var v=document.getElementById("reg_type").value;
	//alert(v);
	if(v=="others")
	{
		
		document.getElementById("add_reg").style.display="block";
		document.getElementById("add_reg").disabled = false;
		
	}
	else
	{
		document.getElementById("add_reg").style.display="none";
		document.getElementById("add_reg").disabled = true;
	}
}

function show_section()
{
	//alert("hello");
	var designation = document.getElementById("designation");
	var designationtext = designation.options[designation.selectedIndex].text;
	//alert(designationtext);
	//var v=document.getElementById("designation").html;
	if(designationtext=="OC")
	{
	
		document.getElementById("sub_sec").style.display="block";
		document.getElementById("section").disabled = false;
		
	}
	else
	{
		document.getElementById("sub_sec").style.display="none";
		document.getElementById("section").disabled = true;
	}
}


function category_Others()
{
	
	var v=document.getElementById("category").value;
	if(v=="category_Others")
	{
	
		document.getElementById("add_category").style.display="block";
		document.getElementById("add_cat").disabled = false;
		
	}
	else
	{
		document.getElementById("add_category").style.display="none";
		document.getElementById("add_cat").disabled = true;
	}
}
function lettr_category_Others()
{
	
	var v=document.getElementById("letter_cat").value;
	if(v=="lettr_category_Others")
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

function add_note_sug(v)
{
	
	
	//alert("gg");
	//$('#txt_note').css({'display':'none'});
		document.getElementById("txt_note").style.display="block";
		//document.getElementById("add_authority_name").disabled = false;
		
	
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
//setInterval(blinker, 1000);
//  function flashtext(ele,col) {
//             var tmpColCheck = document.getElementById( ele ).style.color;

//               if (tmpColCheck === 'lime') {
//                 document.getElementById( ele ).style.color = col;
//               } else {
//                 document.getElementById( ele ).style.color = 'lime';
//               }
//             } 
            
//             setInterval(function() {
//                 flashtext('flashingtext','red');
//                 flashtext('flashingtext2','red');
               
//             }, 500 );
// //for back button
// history.pushState({ page: 1 }, "Title 1", "#no-back");
// window.onhashchange = function (event) {
//   window.location.hash = "no-back";
// };
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

// function ValidateDate() {
// var EffectiveDate = $("#issue_dt").val().split("/"); 
// //alert(EffectiveDate[2]);
// var today = new Date();
// var dd = today.getDate();
// var mm = today.getMonth()+1; //January is 0!
// var yyyy = today.getFullYear();

// if(dd<10) {
//     dd='0'+dd
// } 

// if(mm<10) {
//     mm='0'+mm
// } 

// today = dd+'/'+mm+'/'+yyyy;



// if(((EffectiveDate[0]<dd && EffectiveDate[1]<=mm) || (EffectiveDate[0]>dd && EffectiveDate[1]<mm)) || EffectiveDate[2]<yyyy)
//  {
//       $("#file_ref").attr('readonly', false);

//  }
//  else
//  {
//    $("#file_ref").attr('readonly', true);
//  }
// };
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
$(document).on('click', '.flip', function(){

    var idd='#shpanel'+this.id.slice(4);
      $('.shpanel').not($(idd)).slideUp(800);
		$(idd).slideToggle();
		
		 // $(idd).scrollTo($(idd).right,$(idd).bottom);
        //$('html,body').animate({scrollTop: $(this).offset().top}, 800); 
    
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

function r_color(cls) 
{
	//alert(id);
	sessionStorage.setItem("ro",cls);
	$('.'+cls).css({"background-color":"#FFFF4C","box-shadow":"0px 0px 10px #0000ff","-webkit-box-shadow": "0px 0px 10px #0000ff","-moz-box-shadow": "0px 0px 30px #0000ff"});

 
}

function get_color() 
{
	//alert(localStorage.co);
	if(sessionStorage.ro!="")
	{
	$('.'+sessionStorage.ro).css({"background-color":"#FFFF4C"," box-shadow":"0px 0px 10px #0000ff","-webkit-box-shadow": "0px 0px 10px #0000ff","-moz-box-shadow": "0px 0px 30px #0000ff"});

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



$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		});

function ajaxfilerefno()
{
	 var csrf_test_name=$("input[name=csrf_test_name]").val();
	var base_url=$("#site_url").val();
	var file_id=$("#file_id").val();
	//alert("okk");
	var url=base_url+"file_registration/ajax_file_refno_gen/";
	var category="";
		/* if($("#category").val() =="category_Others"){

			category=($("#add_cat").val()).toUpperCase();
			//alert("mmmm add");
			
		}
		else if($("#category").val()!=""){ 
			var cat_str=($("#category").val()).split("|");
			 category=cat_str[1];
			//alert($("#category").val());
		}
		 */
	
	var add_cat;

	if($("#add_cat").val() !=""){
		add_cat=$("#add_cat").val();
		
	}
	else{
		add_cat="";	
		
	}
	var sub_cat;
	if($("#sub_cat").val() !=""){
		sub_cat=$("#sub_cat").val().toUpperCase();
	}
	else{
		sub_cat="";	
	}
	var issue_dt=$("#issue_dt").val();
	var authority;
	var auth   = ($("#authority").val()).split("|");
	//alert(auth);
	if($("#subsec_list").val()!=null){
		
		var subSec_val=($("#subsec_list").val()).split("|");
		//alert(subSec_val[1]);
		authority   = subSec_val[1];
	}
	else{
	 		authority=auth[1];
	 	}
	//alert(authority);
	var add_authority_name=$("#add_authority_name").val();
	if(category=='category_Others')
	{
      category=add_cat;
      category=category.charAt(0).toUpperCase();
     // alert("kk"+add_cat);
	}
	else{
		category=category;
		//alert("gg"+category);
	}
	var subsec=($("#sub_sec").val()).split("|");
	var sub_sec=subsec[1];
	var temp,atemp;
	
	if(authority !=null){
                atemp=authority+'/';
    }
    else{
    	atemp='';
    }
	
	if(sub_sec !=null){
                temp=sub_sec+'/';
    }
    else{
    	temp='';
    }
	

// str = add_authority_name.replace(/\s\s+/g, ' ');
// var res = str.split(" ");
// var text="";
// for (i = 0; i < res.length; i++) { 
// 	var c = res[i].charAt(0);
// 	if(c=='(')
// 	{
//       break;
// 	}
//     text += c.toUpperCase() ;
// }

// if(authority=='add_authority_name')
// 	{
//       authority=text;
// 	}
// 	else{
// 		authority=authority;
// 	}

	 var prev='CID/'+atemp+temp+sub_cat+'/';	
	
	$.ajax({
			url: url,
			type: 'POST',
			data: {csrf_test_name:csrf_test_name,prev:prev,issue_dt:issue_dt,file_id:file_id},
			success:function(data){
				//alert(data);
				
					$("#file_ref").val(data);
				

				
			}
		});
	
	
}

function filtercategory()
{
	 var csrf_test_name=$("input[name=csrf_test_name]").val();
	var base_url=$("#site_url").val();
	
	//var file_id=$("#file_id").val();

	
		
		//alert(sec_id);

	var sec   = ($("#authority").val()).split("|");
	
	if($("#subsec_list").val()!=null){
		
		var subSec_val=($("#subsec_list").val()).split("|");
		//alert(subSec_val[1]);
		sec_id   = subSec_val[0];
	}
	else{
	 		sec_id=sec[0];
	 	}
	var url=base_url+"file_registration/filtercategory/";

	
	//alert(sec_id);
	$.ajax({
			url: url,
			type: 'POST',
			data: {csrf_test_name:csrf_test_name,sec_id:sec_id},
			success:function(data){
				//alert(data);
				if(data){
					$("#category").html(data);
					$('#add_category').css({'display':'none'});
				}
				else{
					
					$('#add_category').css({'display':'block'});
					$('#add_category').css({'disabled':'false'});
					$('#category').html('<option value="category_Others" selected>Others</option>');
					
					
				}
			}
		});
	
	
}

 $('.extrnal-search').on('keyup',function(event) {

   var csrf_test_name=$("input[name=csrf_test_name]").val();
	var base_url=$("#site_url").val();
	var url=base_url+"letter_inbox/ajax_extranal_letter_send/";
	var org=$(this).val();
	$(".extrnal-hid").css("display","block");
	$.ajax({
			url: url,
			type: 'POST',
			data: {csrf_test_name:csrf_test_name,org:org},
			success:function(data){
				
			    if(data)
			    {
				$('#extrnal_suggest').html(data);
			    }
			    else
			    {
               $('#extrnal_suggest').html('<p style="color:white">no suggestions</p>');
			    }

			}
		});
   
});

$('.note-search').on('keyup',function(event) {
//alert("rr");
   var csrf_test_name=$("input[name=csrf_test_name]").val();
	var base_url=$("#site_url").val();
	var url=base_url+"file_inbox/ajax_note/";
	var org=$(this).val();
	$(".extrnal-hid").css("display","block");
	$.ajax({
			url: url,
			type: 'POST',
			data: {csrf_test_name:csrf_test_name,org:org},
			success:function(data){
				
			    if(data)
			    {
				$('#note_suggest').html(data);
			    }
			    else
			    {
               $('#note_suggest').html('<p style="color:white">no suggestions</p>');
			    }

			}
		});
   
});



function extrnal_value(v)
{
	var result=$("#"+v).html();
	
   $("#receiver_address").val(result);
   $(".extrnal-hid").css("display","none");
   
}

function note_sug(v)
{
	
	var result =$("#"+v).html();
	
	tinyMCE.activeEditor.setContent(result);
   //$("#note").val(result);
   //$(".extrnal-hid").css("display","none");
   
}

function note_text_type(v){

	if(v == 'note_text')
	{
		$(".ntxt").css("display","block");
		$(".snote").css("display","none");
		$('#note').removeAttr("disabled");
		$('#scanfile').attr("disabled","disabled");
		
	}
	else 
	{
		
		$(".ntxt").css("display","none");
		$(".snote").css("display","block");
		$('#note').attr("disabled","disabled");
		$('#scanfile').removeAttr("disabled");
	}
	
}

// filtercategory();
notifcation(); 
getcolor();
get_color();
receivertype("IN");


$(document).ready(function(){
 $(".datepicker").attr("placeholder", "DD/MM/YY");
 $(".datepicker").attr('readonly', true);
 
})