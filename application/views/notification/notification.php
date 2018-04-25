<li class="dropdown pull-right">
	<div id="sound"></div>
<a href="#" class="dropdown-toggle <?php echo $notifcation_count>0 ? 'noti2':'noti1'; ?>" id="gj" data-toggle="dropdown"> <span class="glyphicon glyphicon-bell"></span><?php echo $notifcation_count ;?><span class="caret"></span></a>
    <input type="hidden" value="<?php echo $notifcation_count ;?>" id="c">
    <ul class="dropdown-menu dropdown-alert" role="menu">
        <?php foreach ($action_notifcation as $value){ ?>
        <li><a href="<?php echo base_url().'actionable_letter'; ?>" onclick="rcolor('<?php echo 'c2'.$value['action_id'] ?>')"><svg class="glyph stroked cancel"><use xlink:href=""></use></svg><?php echo $value['memo_no'].'---'.$value['action_details'] ?></a></li>
        <?php }?>
        <hr><li><a href="<?php echo base_url().'actionable_letter';?>" onclick="rcolor('')"><svg class="glyph stroked cancel"><use xlink:href=""></use></svg> Read More ...</a></li>
    </ul>

</li> 
