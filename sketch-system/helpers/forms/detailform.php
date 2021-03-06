<?php if(isset($_POST['error'])){?>
<?php 		echo $_POST['error']; ?>
<?php } 
	$memPage = getData("sketch_menu","menu_guid","sketch_menu_id=".intval($this->e('memberpage')));
	$memPage->advance();

if(!isset($_REQUEST['preview'])){
?>
<form class="required" method="post" action="<?php echo urlPath($memPage->menu_guid); ?>">
<?php } ?>
  <?php if(memberid()){ ?>
  <h2>Update your details</h2>
    <input name="update" value="yes" type="hidden" />
  <?php }else{ ?>
    <h2>Register</h2>
     <input name="register" value="yes" type="hidden" />
  <?php } ?>
  <input name="token" type="hidden" value="<?php $tok = md5(rand()); sessionAdd('token',$tok,false); echo sessionGet('token'); ?>"/>
  <ul class="forms">
    <li>
        <label>First name</label>
        <input type="text" class="required" value="<?php echo $_POST['firstname'];?>" name="firstname">
    </li>
    <li>
        <label>Last name</label>
        <input type="text" class="required" value="<?php echo $_POST['lastname'];?>" name="lastname">
    </li>
    <li>
        <label>Nickname</label>
        <input type="text" class="required" value="<?php echo $_POST['nickname'];?>" name="nickname">
   </li>
   <?php if(!memberid()) {?>
    <li>
        <label>Password</label>
	<?php $req = "required"; ?>
        <input type="password" class="<?php echo $req; ?> password" name="password">
   </li>
   <?php } ?>
   <?php if(adminCheck()) {?>
    <li>
        <label>Password</label>
        <input type="text" class="required password" name="password" value="<?php echo secureit($_POST['password'],true); ?>">
   </li>
   <?php } ?>
    <li>
        <label>Email</label>
        <input type="text" class="required email" value="<?php echo $_POST['email'];?>" name="email">
   </li>
    <li>
        <label>Address</label>
        <input type="text" class="required" value="<?php echo $_POST['address'];?>" name="address">
    </li>
    <li>
        <label>Postcode</label>
        <input type="text" class="required integer" value="<?php echo $_POST['postcode']; ?>" name="postcode">
   </li>
    <li>
        <label>City</label>
        <input type="text" class="required" value="<?php echo $_POST['city'];?>" name="city">
    </li>
    <li>
        <label>Country</label>
        <input type="text" class="required" value="<?php echo $_POST['country']; ?>" name="country">
   </li>
   <?php if(adminCheck()){ ?>
   <li>
  
        <label>Member Group (select existing groups from this list)</label>
		<select name="menu_sel" class="bgClass:'select_bg'" onchange="$('theClass').value = $('theClass').value +','+this.value">
		    <option value="">All Members</option>
            <?php
			$found = false;
			$memdata = getData("sketch_page,sketch_menu","menu_class","page_status='member' GROUP BY menu_class");
			while($memdata->advance()){
				if($memdata->menu_class != ''){
					$found=true
				?><option value="<?php echo $memdata->menu_class; ?>"><?php echo $memdata->menu_class; ?></option><?php	
				}
			}
			?>
		</select>
        <label>
		<?php if(!$found){ ?>
        	<div class="alert" style="width:95%;">No Member Group Found - Enter the member group here to create a group</div>
        <?php }else{ ?>
        	Enter a new group name below or select one from above (Comma seperate to make members part ofr different groups)
        <?php } ?>
        </label>
        <input name="group" id="theClass" value="<?php echo $_POST['group']; ?>"/>
       </li>
   
   <?php } ?>
   
<?php if(!isset($_REQUEST['preview'])){ ?>
   <li>
       <?php if(!memberid()){ ?>
        <button type="submit">Sign Up</button>
	<?php }else{ ?>
	<button type="submit">Update Details</button>
	<?php } ?>
   </li>
<?php } ?>
  </ul>
<?php if(!isset($_REQUEST['preview'])){ ?>
</form>
<?php } ?>