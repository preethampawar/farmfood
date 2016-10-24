Dear <?php echo $user_info['User']['name'];?>, 

<p>Please follow the below link to reset your password.</p>
<pre>
<a href="<?php echo $this->Html->url($link, true);?>">Link</a>: <?php echo $this->Html->url($link, true);?>
</pre>
<p>The above reset link is valid for 7 days from now.</p>

<p>In case if you have any questions or queries please mail to us at <b><i>support@farmfood.in</i></b></p>
<p><a href="http://www.farmfood.in">Visit Farm Food Website</a></p>

<p>
- <br>
Team Farm Food
</p>
<br>
<p>Note* : This is a system generated message and please do not respond to this email.</p>
