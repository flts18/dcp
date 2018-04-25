+

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar" style="background-color:rgba(48, 67, 86, 0.96);">
		<ul class="nav menu">

		   

			<li *class="<?php if(isset($active) && $active == 'home_page') echo 'active';?>"><a href="<?php echo base_url(); ?>" onclick="window.history.go(-1); return false;"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-hand-left"></span> Back</a></li>

			<li class="<?php if(isset($active) && $active == 'home_page') echo 'active';?>"><a href="<?php echo base_url(); ?>home_controller/lettertraking"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
			
			<li class="<?php if(isset($active) && $active == 'registration_page') echo 'active';?>"><a href="<?php echo base_url(); ?>letter_registration" onclick="r_color('<?php echo '' ?>')"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-edit"> </span> Paper Registration</a></li>
			
			<li class="<?php if(isset($active) && $active == 'letter_inbox_page') echo 'active';?>"><a href="<?php echo base_url(); ?>letter_inbox"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-envelope"> </span> Inbox <span id="flashingtext"><B></B></span></a></li>
			<li class="<?php if(isset($active) && $active == 'action_letter_page') echo 'active';?>"><a href="<?php echo base_url(); ?>actionable_letter"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-send"> </span> Sent Paper <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Actionable)</b></a></li>
			<li class="<?php if(isset($active) && $active == 'request_approval_page') echo 'active';?>"><a href="<?php echo base_url(); ?>actionable_letter/requests_for_approval"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-send"> </span> Request's For <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Approval</b></a></li>
			<li class="<?php if(isset($active) && $active == 'registered_letterlist') echo 'active';?>"><a href="<?php echo base_url(); ?>letter_registration/letter_register" onclick="r_color('<?php echo '' ?>')"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-file"> </span> Created Papers <span id="flashingtext2"><b><?php echo letter_registar_count()  ;?></b></span></a></li>
			
			<li class="<?php if(isset($active) && $active == 'star_letter') echo 'active';?>"><a href="<?php echo base_url(); ?>letter_registration/star_letter_reports"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-envelope"> </span> Star Papers</a></li>
            
            <li class="parent">
				<a data-toggle="collapse" href="#sub-item-1" class="<?php if(isset($active) && ($active == 'memo_page' || $active == 'by_category_page' || $active == 'by_text_page' || $active =='by_subject_page' || $active =='by_date_page' || $active =='by_sending_authority_page')) echo 'parent-active';?>">
				<span >
					<svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-search"> </span> Track Paper  &nbsp;<i class="glyphicon glyphicon-chevron-down" ></i>
				</span></a>
			</a>
				<ul class="<?php if(isset($active) && ($active == 'memo_page'  || $active == 'by_category_page' || $active == 'by_text_page' || $active =='by_subject_page' || $active =='by_date_page' || $active =='by_sending_authority_page')) echo 'children collapse in'; else echo 'children collapse' ;?>" id="sub-item-1">
                
                <li>
						<a class="<?php if(isset($active) && $active =='memo_page') echo 'active';?>" href="<?php echo base_url(); ?>track_letter/track_letter_bymemono">
							<svg class="glyph stroked chevron"><use xlink:href="#stroked-chevron"></use></svg>  Memo No
						</a>
					</li>
					                    
                    <li>
						<a class="<?php if(isset($active) && $active =='by_text_page') echo 'active';?>" href="<?php echo base_url(); ?>track_letter/track_letter_bytext">
							<svg class="glyph stroked chevron"><use xlink:href="#stroked-chevron"></use></svg>  Keyword
						</a>
					</li>
                    
                     <li>
						<a class="<?php if(isset($active) && $active =='by_subject_page') echo 'active';?>" href="<?php echo base_url(); ?>track_letter/track_letter_bysubject">
							<svg class="glyph stroked chevron"><use xlink:href="#stroked-chevron"></use></svg>  Subject
						</a>
					</li>
					   
					    <li>
						<a class="<?php if(isset($active) && $active =='by_category_page') echo 'active';?>" href="<?php echo base_url(); ?>track_letter/track_letter_bycategory">
							<svg class="glyph stroked chevron"><use xlink:href="#stroked-chevron"></use></svg>  Category
						</a>
					</li>     

					 <li>
						<a class="<?php if(isset($active) && $active =='by_sending_authority_page') echo 'active';?>" href="<?php echo base_url(); ?>track_letter/track_letter_bysending_authority">
							<svg class="glyph stroked chevron"><use xlink:href="#stroked-chevron"></use></svg>  Sending Authority
						</a>
					</li>

					 <li>
						<a class="<?php if(isset($active) && $active =='by_date_page') echo 'active';?>" href="<?php echo base_url(); ?>track_letter/track_letter_bydate">
							<svg class="glyph stroked chevron"><use xlink:href="#stroked-chevron"></use></svg>  Paper Creation Date
						</a>
					</li>


		</ul>

		
		<?php if($this->session->userdata('user_type')=="admin"){ ?>
			<li class="<?php if(isset($active) && $active == 'add_section_page') echo 'active';?>"><a href="<?php echo base_url(); ?>user/add_section"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-plus-sign"></span> Add Section </a></li>
			<a href="<?php echo base_url(); ?>user/signup" style="color:#fff"><u>Register User</u></a></li>
			<?php }?>

			<?php if($this->session->userdata('user_type')=="admin" || $this->session->userdata('user_type')=="priv_user"){ ?>
			<li class="<?php if(isset($active) && $active == 'add_sub_section_page') echo 'active';?>"><a href="<?php echo base_url(); ?>user/add_sub_section"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-plus"></span> Add Sub Section </a></li>
			<?php }?>
		<?php if($this->session->userdata('user_type')=="admin" || $this->session->userdata('user_type')=="priv_user"){ ?>
			<li class="<?php if(isset($active) && $active == 'user_list_page') echo 'active';?>"><a href="<?php echo base_url(); ?>user/user_list"><svg class="glyph stroked dashboard"><use xlink:href="#stroked-dashboard"></use></svg><span class="glyphicon glyphicon-cog"> </span>Manage User</a></li>
			<?php }?>		
	</div>
	


	